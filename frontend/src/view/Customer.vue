<script setup lang="ts">
import { onMounted, ref } from "vue";
import axios from "axios";
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
  CardFooter,
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
import { FormItem } from "@/components/ui/form";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
  SelectGroup,
  SelectLabel,
} from "@/components/ui/select";
import { Input } from "@/components/ui/input";
import { ScrollArea } from "@/components/ui/scroll-area";
import { Button } from "@/components/ui/button";
import { API_URL } from "../config/api";
import type { Customer } from "./types/customer";

const customer = ref<Customer[]>([]);
const name = ref("");
const gender = ref("");
const email = ref("");
const phone = ref("");

const clearInput = () => {
  name.value = "";
  gender.value = "";
  email.value = "";
  phone.value = "";
};

const fetchData = async () => {
  const response = await fetch(API_URL + "/cus.get");
  customer.value = (await response?.json()) ?? [];
};

const handleCreate = async () => {
  try {
    await axios({
      method: "post",
      url: API_URL + "/cus.create",
      data: {
        name: name.value,
        gender: gender.value,
        email: email.value,
        phone: phone.value,
      },
    });
    fetchData();
    clearInput();
  } catch (err) {
    console.log(err);
  }
};

const handleEdit = (e: number) => {
  alert(e);
};

const handleDelete = async (id: number) => {
  try {
    await axios({
      method: "delete",
      url: API_URL + "/cus.delete/" + id,
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
  <!--  -->
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
                <Input v-model="gender" type="text" />
              </FormItem>
              <FormItem class="mt-2">
                <label for="email">Email:</label>
                <Input v-model="email" type="email" />
              </FormItem>
              <FormItem class="mt-2">
                <label for="phone">Phone:</label>
                <Input v-model="phone" type="text" />
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
        <ScrollArea class="h-[700px] rounded-md border p-4">
          <Table>
            <TableCaption>A list of your recent invoices.</TableCaption>
            <TableHeader>
              <TableRow>
                <TableHead>No</TableHead>
                <TableHead>Name</TableHead>
                <TableHead>Gender</TableHead>
                <TableHead>Email</TableHead>
                <TableHead>Phone</TableHead>
                <TableHead>Action</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <TableRow v-for="(row, index) in customer" :key="row.id">
                <TableCell>{{ index + 1 }}</TableCell>
                <TableCell>{{ row.name }}</TableCell>
                <TableCell>{{ row.gender }}</TableCell>
                <TableCell>{{ row.email }}</TableCell>
                <TableCell>{{ row.phone }}</TableCell>
                <TableCell class="flex gap-2">
                  <TooltipProvider>
                    <Tooltip>
                      <TooltipTrigger
                        ><Button @click="() => handleEdit(row.id)"
                          >Edit</Button
                        ></TooltipTrigger
                      >
                      <TooltipContent>
                        <p>Edit Customer Information</p>
                      </TooltipContent>
                    </Tooltip>
                  </TooltipProvider>
                  <TooltipProvider>
                    <Tooltip>
                      <TooltipTrigger
                        ><Button @click="handleDelete(row.id)"
                          >Delete</Button
                        ></TooltipTrigger
                      >
                      <TooltipContent>
                        <p>Delete Customer Information</p>
                      </TooltipContent>
                    </Tooltip>
                  </TooltipProvider>
                </TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </ScrollArea>
      </CardContent>
    </Card>
  </div>
</template>
