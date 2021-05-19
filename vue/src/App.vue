<template>
  <div id="app">
    <div class="ui fixed inverted menu vue-color">
      <div class="ui container">
        <a href="#" class="header item">Aplikasi Management Email</a>
      </div>
    </div>

    <div class="ui main container">
      <MyForm :form="form" @onFormSubmit="onFormSubmit" />
      <Loader v-if="loader" />
      <CustomerList
        :customers="customers"
        @onDelete="onDelete"
        @onEdit="onEdit"
      />
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="detailModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>test</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import MyForm from "./components/MyForm";
import CustomerList from "./components/CustomerList";
import Loader from "./components/Loader";

export default {
  name: "App",
  components: {
    MyForm,
    CustomerList,
    Loader,
  },
  data() {
    return {
      url: "http://127.0.0.1:8000/api/customers",
      customers: [],
      form: { first_name: "", last_name: "", email: "", isEdit: false },
      loader: false,
    };
  },
  methods: {
    getCustomers() {
      this.loader = true;

      axios.get(this.url).then((data) => {
        this.customers = data.data;
        this.loader = false;
      });
    },
    deleteCustomer(id) {
      this.loader = true;

      axios
        .delete(`${this.url}/${id}`)
        .then(() => {
          this.getCustomers();
        })
        .catch((e) => {
          alert(e);
        });
    },
    createCustomer(data) {
      this.loader = true;

      axios
        .post(this.url, {
          first_name: data.first_name,
          last_name: data.last_name,
          email: data.email,
        })
        .then(() => {
          this.getCustomers();
        })
        .catch((e) => {
          alert(e);
        });
    },
    editCustomer(data) {
      this.loader = true;

      axios
        .put(`${this.url}/${data.id}`, {
          first_name: data.first_name,
          last_name: data.last_name,
          email: data.email,
        })
        .then(() => {
          this.getCustomers();
        })
        .catch((e) => {
          alert(e);
        });
    },
    onDelete(id) {
      // window.console.log("app delete " + id);

      this.deleteCustomer(id);
    },
    onEdit(data) {
      // window.console.log("app edit ", data);

      this.form = data;
      this.form.isEdit = true;
    },
    onFormSubmit(data) {
      // window.console.log("app onFormSubmit", data);

      if (data.isEdit) {
        // call edit customer
        this.editCustomer(data);
      } else {
        // call create customer
        this.createCustomer(data);
      }
    },
  },
  created() {
    this.getCustomers();
  },
};
</script>

<style>
.vue-color {
  background: #41b883 !important;
}

.main.container {
  margin-top: 60px;
}

.submit-button {
  margin-top: 24px !important;
  float: right;
}

.data {
  margin-top: 15px;
}

thead tr th {
  background: #e0e0e0 !important;
}

.ui.inverted.dimmer {
  background-color: rgba(255, 255, 255, 0) !important;
}
</style>
