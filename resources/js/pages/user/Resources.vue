<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <resourceList></resourceList>
      </div>
    </div>
  </div>
</template>

<script>
  import resourceList from '../../components/resource/resource-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      resourceList
    }
  }
</script>