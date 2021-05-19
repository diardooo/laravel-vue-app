i<template>
  <div class="container">
    <tr>
      <td>{{ customer.id }}</td>
      <td>{{ customer.first_name }} {{ customer.last_name }}</td>
      <td>{{ customer.email }}</td>
      <td>
        <button class="mini ui blue button" @click="onEdit">Edit</button>
        <button class="mini ui red button" @click="onDelete">Delete</button>
        <button
          class="mini ui red button"
          @click="onDetail(customer.id)"
          data-toggle="modal"
          data-target="#detailModal"
        >
          Details
        </button>
      </td>
    </tr>
  </div>
</template>

<script>
export default {
  name: "Customer",
  props: {
    customer: {
      type: Object,
    },
  },
  data() {
    return {
      email: [],
    };
  },
  methods: {
    onDelete() {
      // window.console.log("customer delete " + this.customer.id);
      this.$emit("onDelete", this.customer.id);
    },
    onEdit() {
      // window.console.log("customer edit " + this.customer.id);
      this.$emit("onEdit", this.customer);
    },
    onDetail(id) {
      fetch(`http://127.0.0.1:8000/api/getEmail?customer=${id}`)
        .then((res) => res.json())
        .then((data) => (this.email = data.data))
        .catch((error) => console.log(error));
      console.log(this.email);
    },
  },
};
</script>

<style scoped></style>
