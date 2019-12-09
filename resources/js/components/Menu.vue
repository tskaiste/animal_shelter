<template>
  <nav class="navbar navbar-expand-lg navbar-light" id="nav">
    <div class="container">
      <router-link :to="{name: 'home'}" class="logo">Animal Shelter</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li
            class="nav-item"
            v-if="!$auth.check()"
            v-for="(route, key) in routes.unlogged"
            v-bind:key="route.path"
          >
            <router-link class="nav-link" :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
          </li>
          <li
            class="nav-item"
            v-if="$auth.check(1)"
            v-for="(route, key) in routes.user"
            v-bind:key="route.path"
          >
            <router-link class="nav-link" :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
          </li>
          <li
            class="nav-item"
            v-if="$auth.check(2)"
            v-for="(route, key) in routes.admin"
            v-bind:key="route.path"
          >
            <router-link class="nav-link" :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
          </li>
          <li class="nav-item" v-if="$auth.check()">
            <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      routes: {
        // UNLOGGED
        unlogged: [
          // {
          //   name: "Register",
          //   path: "register"
          // },
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
  }
};
</script>