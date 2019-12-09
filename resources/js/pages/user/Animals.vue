<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <animalList></animalList>
      </div>
    </div>
  </div>
</template>

<script>
  import animalList from '../../components/animal/animal-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      animalList
    }
  }
</script>