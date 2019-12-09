<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <donationList></donationList>
      </div>
    </div>
  </div>
</template>

<script>
  import donationList from '../../components/donation/donation-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      donationList
    }
  }
</script>