<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "axios";

const data = ref([]);
const formData = ref([]);

const fetchData = async () => {
  try {
    const response = await fetch("http://127.0.0.1:8000/api/cus.get");
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    data.value = await response.json();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

const handleSubmit = async () => {
  try {
    const response = await axios.post(
      "http://127.0.0.1:8000/api/cus.create",
      this.formData.value
    );

    this.responseMessage = "Form submitted successfully!";
    console.log("API response:", response.data);
  } catch (error) {
    this.responseMessage = "There was an error submitting the form.";
    console.error("API error:", error);
  }
};

onMounted(() => {
  fetchData();
});

const show = (e) => {
  alert(e);
};

// Submit the data
</script>

<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form @submit.prevent="handleSubmit">
          <input
            v-model="name"
            type="text"
            class="form-control"
            placeholder="name"
          />
          <input
            v-model="gender"
            type="text"
            class="form-control"
            placeholder="gender"
          />
          <input
            v-model="email"
            type="text"
            class="form-control"
            placeholder="email"
          />
          <input
            v-model="phone"
            type="text"
            class="form-control"
            placeholder="phone"
          />
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <p v-if="msg">{{ msg }}</p>
      </div>
    </div>
  </div>
  <div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in data" :key="row.id">
          <td>{{ row.id }}</td>
          <td>{{ row.name }}</td>
          <td>{{ row.gender }}</td>
          <td>{{ row.email }}</td>
          <td>{{ row.phone }}</td>
          <td>
            <button class="btn btn-warning me-2" @click="show(row.id)">
              Edit
            </button>
            <button class="btn btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
