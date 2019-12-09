<template>
  <footer class="page-footer font-small">
    <div class="container d-flex">
      <ul>
        <li v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
          <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </li>
        <li v-if="$auth.check(1)" v-for="(route, key) in routes.user" v-bind:key="route.path">
          <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </li>
        <li v-if="$auth.check(2)" v-for="(route, key) in routes.admin" v-bind:key="route.path">
          <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </li>
        <li v-if="$auth.check()">
          <a href="#" @click.prevent="$auth.logout()">Logout</a>
        </li>
      </ul>
      <div class="apply-box">
        <p>If you wish to adopt a pet, leave information about yourself by clicking the button below:</p>
        <button
          class="btn btn-primary"
          @click="add"
        >Apply</button>
      </div>
    </div>
    <client-create ref="create_client_modal"></client-create>
  </footer>
</template>

<script>
import clientCreate from "./client/client-create.vue";
export default {
  data() {
    return {
      routes: {
        // UNLOGGED
        unlogged: [
          {
            name: "Login",
            path: "login"
          }
        ],

        // LOGGED USER
        user: [
          {
            name: "Animals",
            path: "animals"
          },
          {
            name: "Resources",
            path: "resources"
          },
          {
            name: "Cages",
            path: "cages"
          },
          {
            name: "Bills",
            path: "bills"
          },
          {
            name: "Donations",
            path: "donations"
          },
          {
            name: "Clients",
            path: "clients"
          }
        ],
        // LOGGED ADMIN
        admin: [
          {
            name: "Shelters",
            path: "shelters"
          },
          {
            name: "Employees",
            path: "employees"
          }
        ]
      }
    };
  },
  mounted() {
    //
  },
  components: {
    "client-create": clientCreate
  },
  methods: {
    add() {
      $("#create_client_modal").modal("show");
    }
  }
};
</script>