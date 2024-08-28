<script setup lang="ts">
import { onMounted, ref } from "vue";
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import type { Customer } from "./types/customer";

const customer = ref<Customer[]>([]);

const fetchData = async () => {
  const response = await fetch("http://127.0.0.1:8000/api/cus.get");
  customer.value = (await response?.json()) ?? [];
  console.log(customer);
};

onMounted(() => {
  fetchData();
});
</script>

<template>
  <div class="container">
    <Table>
      <TableCaption>A list of your recent invoices.</TableCaption>
      <TableHeader>
        <TableRow>
          <TableHead>Name</TableHead>
          <TableHead>Gender</TableHead>
          <TableHead>Email</TableHead>
          <TableHead>Phone</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="row in customer" key="row.id">
          <TableCell>{{ row.name }}</TableCell>
          <TableCell>{{ row.gender }}</TableCell>
          <TableCell>{{ row.email }}</TableCell>
          <TableCell>{{ row.phone }}</TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
</template>
