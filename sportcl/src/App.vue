<script>
  import topMenu from './components/TopMenu'
  import {mapState} from 'vuex'

  export default {
    components: {
      topMenu
    },
    computed: {
      ...mapState({
        userStore: state => state.userStore
      })

    },
    created () {
      const userObj = JSON.parse(window.localStorage.getItem('authUser'))
      this.$store.dispatch('setUserObject', userObj)
    }
  }
</script>

<template>
    <div class='container'>
      <topMenu></topMenu>
      <router-view></router-view>
    </div>  
</template>

<style lang='sass'>
  @import "assets/css/bootstrap.css"
</style>
