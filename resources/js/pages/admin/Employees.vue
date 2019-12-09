<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <employeeList></employeeList>
      </div>
    </div>
  </div>
</template>

<script>
  import employeeList from '../../components/employee/employee-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      employeeList
    }
  }
</script>