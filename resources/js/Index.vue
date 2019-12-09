<template>
  <div id="main">
    <header id="header">
      <navigationMenu></navigationMenu>
    </header>
    <div id="content">
      <router-view></router-view>
    </div>
    <footer-menu></footer-menu>
  </div>
</template>

<script>
  import navigationMenu from './components/Menu.vue'
  import footerMenu from './components/Footer.vue'
  export default {
    data() {
      return {
        //
      }
    },
    components: {
      navigationMenu,
      footerMenu
    }
  }
</script>