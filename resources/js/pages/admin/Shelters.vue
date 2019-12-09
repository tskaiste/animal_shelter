<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <shelterList></shelterList>
      </div>
    </div>
  </div>
</template>

<script>
  import shelterList from '../../components/shelter/shelter-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      shelterList
    }
  }
</script>