<template>
  <div class="container">
    <CreateModal
      v-if="openModal"
      @close-modal="openModal = false"
      @update-table="updateTable"
    />
    <EditModal
      v-if="companyId"
      :id="companyId"
      @close-modal="companyId = null"
      @update-table="updateTable"
    />
    <div class="row justify-content-center align-items-center mt-5">
      <div class="col-md-8">
        <div class="border">
          <div class="py-3 bg-primary">
            <div class="row justify-content-center align-items-center">
              <div class="col-md-6">
                <form action="" class="">
                  <div class="form-group">
                    <input
                      type="search"
                      class="form-control"
                      placeholder="search"
                    />
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="m-2">
            <button class="btn btn-primary" @click="openModal = true">
              Create
            </button>
          </div>
          <div class="p-2">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="companies.data.length">
                <tr v-for="company in companies.data" :key="company.id">
                  <td>{{ company.name }}</td>
                  <td>{{ company.email }}</td>
                  <td>{{ company.address }}</td>
                  <td class="d-flex">
                    <button
                      class="btn btn-warning mx-1"
                      @click="companyId = company.id"
                    >
                      Edit
                    </button>
                    <button class="btn btn-danger mx-1">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted, reactive } from "vue";
import CreateModal from "../components/CreateModal.vue";
import EditModal from "../components/EditModal.vue";

const companyId = ref(null);
const openModal = ref(false);
const companies = reactive({ data: [] });

const updateTable = async () => {
  try {
    const response = await fetch("/api/v1/companies");
    if (!response.ok) {
      throw response;
    } else {
      companies.data = await response.json();
      openModal.value = false;
      companyId.value = null;
    }
  } catch (response) {
    console.log(response);
  }
};

onMounted(() => {
  updateTable();
});
</script>

<style lang="scss" scoped>
td {
  vertical-align: middle;
}
</style>


