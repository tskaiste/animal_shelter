<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <clientList></clientList>
      </div>
    </div>
  </div>
</template>

<script>
  import clientList from '../../components/client/client-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      clientList
    }
  }
</script>