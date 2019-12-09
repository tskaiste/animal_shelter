<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <cageList></cageList>
      </div>
    </div>
  </div>
</template>

<script>
  import cageList from '../../components/cage/cage-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      cageList
    }
  }
</script>