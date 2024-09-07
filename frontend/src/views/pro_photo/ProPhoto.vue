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
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
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
import { Skeleton } from "@/components/ui/skeleton";
import { useToast } from "@/components/ui/toast/use-toast";
import { FormItem } from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { ScrollArea } from "@/components/ui/scroll-area";
import { Button } from "@/components/ui/button";
import { DOMAIN, API_URL } from "../../config/api";
import type { ProPhoto } from "../types/ProPhoto";
import { Toaster } from "@/components/ui/toast";

const { toast } = useToast();
const pphoto = ref<ProPhoto[]>([]);
const data = ref<ProPhoto[]>([]);
const edit = ref<ProPhoto[]>([]);
let editData;
const datetime = ref(new Date().toLocaleString());

const selectFile = ref("");
const imgUrl = ref("");
const code = ref("");
const pro_id = ref("");

const clearInput = () => {
  code.value = "";
  pro_id.value = "";
  imgUrl.value = "";
  selectFile.value = "";
};

const fetchData = async () => {
<<<<<<< HEAD
  try {
    const response = await fetch(`${API_URL}/photo`);
    pphoto.value = (await response?.json()) ?? [];
    data.value = Object.values(pphoto.value);
    toast({
      title: "Data Fetch",
      description: "Data Fetching successfully",
    });
  } catch (err: any) {
    console.error(err);
    toast({
      title: "Data Fetch",
      description: `Data Fetching Errors: ${err.message}`,
    });
  }
=======
  const response = await fetch(`${API_URL}/photo`);
  pphoto.value = (await response?.json()) ?? [];
  data.value = Object.values(pphoto.value);
  console.log(pphoto.value);
>>>>>>> ff3bc5b0c274a0ae985073007ff46f8b2d4c9a76
};

const handleFileChange = (event: any) => {
  const file = event.target.files[0];
  selectFile.value = file;

  if (file) {
    const reader = new FileReader();
    reader.onload = (event: any) => {
      imgUrl.value = event.target.result;
      const photo: any = document.getElementById("photo");
      photo.style.display = "none";
    };
    reader.readAsDataURL(file);
  }
};

const handleCreate = async () => {
  if (!selectFile.value) {
    alert("Please select a photo to create");
    return;
  } else {
    try {
      await axios({
        method: "post",
        url: `${API_URL}/photo`,
        withCredentials: false,
        headers: {
          "Content-Type": "multipart/form-data",
        },
        data: {
          code: code.value,
          pro_id: pro_id.value,
          photo: selectFile.value,
        },
      })
        .then((respone) => {
          console.log(respone);
        })
        .catch((err) => {
          console.log(err);
        });

      fetchData();
      clearInput();
    } catch (err) {
      console.log(err);
    }
  }
};

const handleEdit = async (id: number) => {
  try {
    const response = await fetch(`${API_URL}/photo/${id}`);
    edit.value = (await response?.json()) ?? [];
<<<<<<< HEAD
    const value: any = Object.values(edit.value);
    console.log(value[1].value);
    // selectFile.value = data[1];
    // name.value = data[2];
    // gender.value = data[3];
    // email.value = data[4];
    // phone.value = data[5];
    // address.value = data[6];
=======
    editData = Object.values(edit.value);
    imgUrl.value = editData[0].photo;
    console.log(editData[0]);
>>>>>>> ff3bc5b0c274a0ae985073007ff46f8b2d4c9a76
  } catch (err) {
    console.log(err);
  }
};

const handleUpdate = async (id: number) => {
  if (!selectFile.value) {
    alert("Please select a photo to create");
    return;
  } else {
    try {
      await axios({
        method: "post",
        url: `${API_URL}/customer/${id}`,
        withCredentials: false,
        headers: {
          "Content-Type": "multipart/form-data",
          "X-HTTP-Method-Override": "PUT",
        },
        data: {
          gender: gender.value,
          email: email.value,
          phone: phone.value,
          address: address.value,
          photo: selectFile.value,
        },
      })
        .then((respone) => {
          console.log(respone);
        })
        .catch((err) => {
          console.log(err);
        });
      fetchData();
      clearInput();
    } catch (err) {
      console.log(err);
    }
  }
};

const handleDelete = async (id: number) => {
  try {
    await axios({
      method: "delete",
      url: `${API_URL}/photo/${id}`,
    })
      .then((respone) => {
        console.log(respone);
      })
      .catch((err) => {
        console.log(err);
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
  <!-- <Button @click="skeleton">test</Button> -->
  <Toaster />
  <div class="container my-8">
    <Card class="drop-shadow shadow-xl">
      <CardHeader>
        <CardTitle>Product Photo</CardTitle>
        <Dialog>
          <DialogTrigger class="flex float-start">
            <Button class="w-[200px]">Add Photo</Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>Add Product Photo</DialogTitle>
              <DialogDescription> </DialogDescription>
            </DialogHeader>
            <form @submit.prevent="handleCreate">
              <div class="flex flex-row gap-4">
                <FormItem class="mt-2 w-full">
                  <label for="name">Code:</label>
                  <Input v-model="code" type="text" placeholder="brand00#" />
                </FormItem>
                <FormItem class="mt-2 w-full">
                  <label for="gender">Product ID:</label>
                  <Select v-model="pro_id">
                    <SelectTrigger>
                      <SelectValue placeholder="Select Product ID" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectGroup v-for="pro in data[0]" :key="pro.id">
                        <SelectItem :value="pro.id">
                          {{ pro.name }}
                        </SelectItem>
                      </SelectGroup>
                    </SelectContent>
                  </Select>
                </FormItem>
              </div>
              <div class="flex flex-row gap-4">
                <FormItem class="mt-2 w-full">
                  <label for="photo">Photo:</label>
                  <Input type="file" @change="handleFileChange" />
                </FormItem>
                <FormItem class="mt-2 w-full">
                  <img
                    v-if="imgUrl"
                    :src="imgUrl"
                    alt="Image Preview"
                    class="h-[100px] rounded-lg"
                  />
                  <img
                    v-else
                    src="../../assets/images/default-image.png"
                    alt="Callback Image"
                    class="h-[100px] rounded-lg"
                  />
                </FormItem>
              </div>
              <FormItem class="mt-2 flex gap-2">
                <DialogClose>
                  <Button
                    type="submit"
                    @click="
                      () => {
                        toast({
                          title: 'Photo Added Successfully',
                          description: `on this day, ${datetime}`,
                        });
                      }
                    "
                  >
                    Submit
                  </Button>
                </DialogClose>
              </FormItem>
            </form>
          </DialogContent>
        </Dialog>
      </CardHeader>
      <CardContent>
        <ScrollArea class="rounded-md border p-4">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>No</TableHead>
                <TableHead class="hidden sm:table-cell">Photo</TableHead>
                <TableHead>Code</TableHead>
                <TableHead>Product ID</TableHead>
                <TableHead class="hidden md:table-cell">Action</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <!--  -->
              <div class="skeleton hidden items-center space-x-4">
                <Skeleton class="h-12 w-12 rounded-full" />
                <div class="space-y-2">
                  <Skeleton class="h-4 w-[250px]" />
                  <Skeleton class="h-4 w-[200px]" />
                </div>
              </div>
              <!--  -->
              <TableRow v-for="(row, index) in data[1]" :key="index">
                <TableCell>{{ index + 1 }}</TableCell>
                <TableCell class="hidden sm:table-cell">
                  <img
                    class="rounded-md h-[50px]"
                    :src="`${DOMAIN}/pro_photo/${row.photo}`"
                    alt="Customer Image"
                  />
                </TableCell>
                <TableCell>{{ row.code }}</TableCell>
                <TableCell>{{ row.pro_name }}</TableCell>
                <TableCell class="gap-2 hidden md:flex">
                  <TooltipProvider>
                    <Dialog>
                      <DialogTrigger class="flex float-start">
                        <Tooltip>
                          <TooltipTrigger
                            ><Button @click="handleEdit(row.id)"
                              >Edit</Button
                            ></TooltipTrigger
                          >
                          <TooltipContent>
                            <p>Edit Product Photo Information</p>
                          </TooltipContent>
                        </Tooltip>
                      </DialogTrigger>
                      <DialogContent>
                        <DialogHeader>
                          <DialogTitle>Edit Information</DialogTitle>
                          <DialogDescription> </DialogDescription>
                        </DialogHeader>
                        <form @submit.prevent="handleUpdate(row.id)">
                          <div class="flex flex-row gap-4">
                            <FormItem class="mt-2 w-full">
                              <label for="name">Code:</label>
<<<<<<< HEAD
                              <Input v-model="code" type="text" />
=======
                              <Input
                                v-model="editData[0].code"
                                type="text"
                                placeholder="brand00#"
                              />
>>>>>>> ff3bc5b0c274a0ae985073007ff46f8b2d4c9a76
                            </FormItem>
                            <FormItem class="mt-2 w-full">
                              <label for="gender">Product ID:</label>
                              <Select v-model="pro_id">
                                <SelectTrigger>
                                  <SelectValue
                                    :placeholder="editData[0].pro_name"
                                  />
                                </SelectTrigger>
                                <SelectContent>
                                  <SelectGroup
                                    v-for="pro in data[0]"
                                    :key="pro.id"
                                  >
                                    <SelectItem :value="pro.id">
                                      {{ pro.name }}
                                    </SelectItem>
                                  </SelectGroup>
                                </SelectContent>
                              </Select>
                            </FormItem>
                          </div>
                          <div class="flex flex-row gap-4">
                            <FormItem class="mt-2 w-full">
                              <label for="name">Description:</label>
                              <Input v-model="desc" type="text" />
                            </FormItem>
                          </div>
                          <div class="flex flex-row gap-4">
                            <FormItem class="mt-2 w-full">
                              <label for="photo">Photo:</label>
                              <Input type="file" @change="handleFileChange" />
                            </FormItem>
                            <FormItem class="mt-2 w-full">
                              <img
                                v-if="imgUrl"
                                :src="`${DOMAIN}/pro_photo/${imgUrl}`"
                                alt="Image Preview"
                                class="h-[100px] rounded-lg"
                              />
                              <img
                                v-else
                                src="../../assets/images/default-image.png"
                                alt="Callback Image"
                                class="h-[100px] rounded-lg"
                              />
                            </FormItem>
                          </div>
                          <FormItem class="mt-2 flex gap-2">
                            <DialogClose>
                              <Button
                                type="submit"
                                @click="
                                  () => {
                                    toast({
                                      title: 'Photo Updated Successfully',
                                      description: `on this day, ${datetime}`,
                                    });
                                  }
                                "
                              >
                                Submit
                              </Button>
                            </DialogClose>
                          </FormItem>
                        </form>
                      </DialogContent>
                    </Dialog>
                  </TooltipProvider>
                  <AlertDialog>
                    <AlertDialogTrigger>
                      <TooltipProvider>
                        <Tooltip>
                          <TooltipTrigger
                            ><Button>Delete</Button></TooltipTrigger
                          >
                          <TooltipContent>
                            <p>Delete Product Photo Information</p>
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
                        <AlertDialogAction @click="handleDelete(row.id)">
                          <Button
                            type="submit"
                            @click="
                              () => {
                                toast({
                                  title: 'Photo Deleted Successfully',
                                  description: `on this day, ${datetime}`,
                                });
                              }
                            "
                          >
                            Continue
                          </Button></AlertDialogAction
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
