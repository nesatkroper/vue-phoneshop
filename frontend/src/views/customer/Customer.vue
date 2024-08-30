<script setup lang="ts">
import { onMounted, ref } from "vue";
import axios from "axios";
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger,
} from "@/components/ui/tooltip";
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { FormItem } from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { ScrollArea } from "@/components/ui/scroll-area";
import { Button } from "@/components/ui/button";
import { DOMAIN, API_URL } from "../../config/api";
import type { Customer } from "../types/customer";

const customer = ref<Customer[]>([]);
const edit = ref<string[]>([]);
const selectFile = ref(null);
const name = ref("");
const gender = ref("");
const email = ref("");
const phone = ref("");
const address = ref("");

const clearInput = () => {
  name.value = "";
  gender.value = "";
  email.value = "";
  phone.value = "";
};

const fetchData = async () => {
  const response = await fetch(`${API_URL}/cus.get`);
  customer.value = (await response?.json()) ?? [];
  clearInput();
};

const handleFileChange = (event: any) => {
  const file = event.target.files[0];
  selectFile.value = file;
};

const handleCreate = async () => {
  if (!selectFile.value) {
    alert("Please select a file to create");
    return;
  }
  console.log(selectFile.value);

  try {
    await axios({
      method: "post",
      url: `${API_URL}/cus.create`,
      withCredentials: false,
      data: {
        name: name.value,
        gender: gender.value,
        email: email.value,
        phone: phone.value,
        address: address.value,
        photo: selectFile.value,
      },
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
    fetchData();
    clearInput();
  } catch (err) {
    console.log(err);
  }
};

const handleEdit = async (id: number) => {
  const response = await fetch(`${API_URL}/cus.only/${id}`);
  edit.value = (await response?.json()) ?? [];
};

const handleUpdate = async (id: number) => {
  try {
    await axios({
      method: "put",
      url: `${API_URL}/cus.update/${id}`,
      data: {
        name: edit.value.name,
        gender: edit.value.gender,
        email: edit.value.email,
        phone: edit.value.phone,
        address: edit.value.address,
      },
    });
    fetchData();
  } catch (err) {
    console.log(err);
  }
};

const handleDelete = async (id: number) => {
  try {
    await axios({
      method: "delete",
      url: `${API_URL}/cus.delete/${id}`,
    });
    fetchData();
  } catch (err) {
    console.log(err);
  }
};

onMounted(() => {
  fetchData();
});
</script>

<template>
  <div class="container mt-6">
    <Card class="drop-shadow">
      <CardHeader>
        <CardTitle>Customer</CardTitle>
        <CardDescription>Customer Information</CardDescription>
        <Dialog>
          <DialogTrigger class="flex float-start">
            <Button class="w-[200px]">Add Customer</Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>Add Customer</DialogTitle>
              <DialogDescription> </DialogDescription>
            </DialogHeader>
            <form @submit.prevent="handleCreate">
              <FormItem class="mt-2">
                <label for="name">Name:</label>
                <Input v-model="name" type="text" />
              </FormItem>
              <FormItem class="mt-2">
                <label for="gender">Gender:</label>
                <Select v-model="gender">
                  <SelectTrigger>
                    <SelectValue placeholder="Select Gender" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectGroup>
                      <SelectLabel>Gender</SelectLabel>
                      <SelectItem value="male"> Male </SelectItem>
                      <SelectItem value="female"> Female </SelectItem>
                      <SelectItem value="other"> Others </SelectItem>
                    </SelectGroup>
                  </SelectContent>
                </Select>
              </FormItem>
              <FormItem class="mt-2">
                <label for="email">Email:</label>
                <Input v-model="email" type="email" />
              </FormItem>
              <FormItem class="mt-2">
                <label for="phone">Phone:</label>
                <Input v-model="phone" type="text" />
              </FormItem>
              <FormItem class="mt-2">
                <label for="address">Address:</label>
                <Input v-model="address" type="text" />
              </FormItem>
              <FormItem class="mt-2">
                <label for="photo">Address:</label>
                <Input type="file" @change="handleFileChange" />
              </FormItem>
              <FormItem class="mt-2 flex gap-2">
                <DialogClose>
                  <Button type="submit">Submit</Button>
                </DialogClose>
              </FormItem>
            </form>
          </DialogContent>
        </Dialog>
      </CardHeader>
      <CardContent>
        <ScrollArea class="h-[1300px] rounded-md border p-4">
          <Table>
            <TableCaption>A list of your recent invoices.</TableCaption>
            <TableHeader>
              <TableRow>
                <TableHead>No</TableHead>
                <TableHead>Name</TableHead>
                <TableHead>Gender</TableHead>
                <TableHead>Email</TableHead>
                <TableHead>Phone</TableHead>
                <TableHead>Address</TableHead>
                <TableHead>Action</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <TableRow v-for="(row, index) in customer" :key="row.id">
                <TableCell>{{ index + 1 }}</TableCell>
                <TableCell>
                  <img
                    class="rounded-md"
                    :src="`${DOMAIN}/customer/${row.photo}`"
                    alt="Customer Image"
                  />
                </TableCell>
                <TableCell>{{ row.name }}</TableCell>
                <TableCell>{{ row.gender }}</TableCell>
                <TableCell>{{ row.email }}</TableCell>
                <TableCell>{{ row.phone }}</TableCell>
                <TableCell>{{ row.address }}</TableCell>
                <TableCell class="flex gap-2">
                  <TooltipProvider>
                    <!--  -->
                    <Dialog>
                      <DialogTrigger class="flex float-start">
                        <Tooltip>
                          <TooltipTrigger
                            ><Button @click="handleEdit(row.id)"
                              >Edit</Button
                            ></TooltipTrigger
                          >
                          <TooltipContent>
                            <p>Edit Customer Information</p>
                          </TooltipContent>
                        </Tooltip>
                      </DialogTrigger>
                      <DialogContent>
                        <DialogHeader>
                          <DialogTitle>Edit Information</DialogTitle>
                          <DialogDescription> </DialogDescription>
                        </DialogHeader>
                        <form @submit.prevent="handleUpdate(row.id)">
                          <FormItem class="mt-2">
                            <label for="name">Name:</label>
                            <p>{{ edit.name }}</p>
                            <Input v-model="edit.name" type="text" />
                          </FormItem>
                          <FormItem class="mt-2">
                            <label for="gender">Gender:</label>
                            <Select v-model="edit.gender">
                              <SelectTrigger>
                                <SelectValue placeholder="Select Gender" />
                              </SelectTrigger>
                              <SelectContent>
                                <SelectGroup>
                                  <SelectLabel>Gender</SelectLabel>
                                  <SelectItem value="male"> Male </SelectItem>
                                  <SelectItem value="female">
                                    Female
                                  </SelectItem>
                                  <SelectItem value="other">
                                    Others
                                  </SelectItem>
                                </SelectGroup>
                              </SelectContent>
                            </Select>
                          </FormItem>
                          <FormItem class="mt-2">
                            <label for="email">Email:</label>
                            <Input v-model="edit.email" type="email" />
                          </FormItem>
                          <FormItem class="mt-2">
                            <label for="phone">Phone:</label>
                            <Input v-model="edit.phone" type="text" />
                          </FormItem>
                          <FormItem class="mt-2">
                            <label for="address">Address:</label>
                            <Input v-model="edit.address" type="text" />
                          </FormItem>
                          <FormItem class="mt-2 flex gap-2">
                            <DialogClose>
                              <Button type="submit">Submit</Button>
                            </DialogClose>
                          </FormItem>
                        </form>
                      </DialogContent>
                    </Dialog>
                    <!--  -->
                  </TooltipProvider>
                  <!--  -->
                  <AlertDialog>
                    <AlertDialogTrigger>
                      <TooltipProvider>
                        <Tooltip>
                          <TooltipTrigger
                            ><Button>Delete</Button></TooltipTrigger
                          >
                          <TooltipContent>
                            <p>Delete Customer Information</p>
                          </TooltipContent>
                        </Tooltip>
                      </TooltipProvider>
                    </AlertDialogTrigger>
                    <AlertDialogContent>
                      <AlertDialogHeader>
                        <AlertDialogTitle
                          >Are you absolutely sure?</AlertDialogTitle
                        >
                        <AlertDialogDescription>
                          This action cannot be undone. This will permanently
                          delete your record and remove your data rom our
                          servers.
                        </AlertDialogDescription>
                      </AlertDialogHeader>
                      <AlertDialogFooter>
                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                        <AlertDialogAction
                          @click="handleDelete(row.id)"
                          class="bg-red-700"
                          >Continue</AlertDialogAction
                        >
                      </AlertDialogFooter>
                    </AlertDialogContent>
                  </AlertDialog>
                </TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </ScrollArea>
      </CardContent>
    </Card>
  </div>
</template>
