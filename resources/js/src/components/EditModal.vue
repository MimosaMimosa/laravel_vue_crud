<template>
  <BackDrop>
    <div class="v-modal-body card mt-4">
      <h5 class="px-4 pt-4">Update Company</h5>
      <div class="card-body px-4 pb-4">
        <form @submit.prevent="updateCompany">
          <div class="form-group mt-1">
            <label for="name">Name</label>
            <input
              type="text"
              class="form-control"
              :class="inputErrors.name && 'is-invalid'"
              v-model="name"
            />
            <div v-show="inputErrors.name" class="invalid-feedback">
              {{ inputErrors.name }}
            </div>
          </div>
          <div class="form-group mt-1">
            <label for="email">Email</label>
            <input
              type="email"
              class="form-control"
              :class="inputErrors.email && 'is-invalid'"
              v-model="email"
            />
            <div v-show="inputErrors.name" class="invalid-feedback">
              {{ inputErrors.email }}
            </div>
          </div>
          <div class="form-group mt-1">
            <label for="address">Address</label>
            <input
              type="address"
              class="form-control"
              :class="inputErrors.address && 'is-invalid'"
              v-model="address"
            />
            <div v-show="inputErrors.address" class="invalid-feedback">
              {{ inputErrors.address }}
            </div>
          </div>
          <div class="d-flex justify-content-end mt-3">
            <button
              class="btn btn-secondary me-2"
              type="button"
              @click="closeModal"
            >
              Close
            </button>
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </BackDrop>
</template>

  <script setup>
import { ref, reactive, onMounted } from "vue";
import BackDrop from "./BackDrop.vue";

const name = ref("");
const email = ref("");
const address = ref("");

const initialState = {
  name: "",
  email: "",
  address: "",
};

const inputErrors = reactive({ ...initialState });

const props = defineProps(["id"]);
const emit = defineEmits(["updateTable", "closeModal"]);

const closeModal = () => {
  emit("closeModal");
};

const setUpdateData = () => {
  emit("updateTable");
};

const findCompany = async () => {
  try {
    const response = await fetch(`/api/v1/companies/${props.id}`);

    if (!response.ok) {
      throw response;
    } else {
      const result = await response.json();
      email.value = result.email;
      name.value = result.name;
      address.value = result.address;
    }
  } catch (response) {
    const { errors: getError } = await response.json();
    console.log(getError);
  }
};

const updateCompany = async () => {
  const body = JSON.stringify({
    name: name.value,
    email: email.value,
    address: address.value,
  });

  try {
    const response = await fetch(`/api/v1/companies/${props.id}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body,
    });
    Object.assign(inputErrors, initialState);

    if (!response.ok) {
      throw response;
    } else {
      setUpdateData();
    }
  } catch (response) {
    console.log(response);
    if (response.status === 422) {
      const { errors: getError } = await response.json();
      Object.entries(getError).forEach(([key, value]) => {
        inputErrors[key] = value[0];
      });
    }
  }
};

onMounted(() => {
  findCompany();
});
</script>
