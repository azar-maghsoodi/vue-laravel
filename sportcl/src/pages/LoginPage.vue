
<script>
  import {userUrl, loginUrl, getHeader} from './../config'
  import {clientId, clientSecret} from './../../env'
  import {mapState} from 'vuex'
  export default {
    computed: {
      ...mapState({
        userStore: state => state.userStore
      })

    },
    data () {
      return {
        login: {
          email: 'azar.maghsoodi@gmail.com',
          password: 'password'
        }
      }
    },
    methods: {
      handleLoginFormSubmit () {
        const postData = {
          grant_type: 'password',
          client_id: clientId,
          client_secret: clientSecret,
          username: this.login.email,
          password: this.login.password,
          scope: ''
        }
        const authUser = {}
        this.$http.post(loginUrl, postData)
          .then(response => {
            if (response.status === 200) {
              console.log('ouath token', response)
              authUser.access_token = response.data.access_token
              authUser.refresh_token = response.data.refresh_token
              window.localStorage.setItem('authUser', JSON.stringify(authUser))
              this.$http.get(userUrl, {headers: getHeader()})
                .then(response => {
                  console.log('user', response)
                  authUser.email = response.body.email
                  authUser.name = response.body.name
                  window.localStorage.setItem('authUser', JSON.stringify(authUser))
                  this.$store.dispatch('setUserObject', authUser)
                  this.$router.push({name: 'dashboard'})
                })
            }
          })
      }
    }
  }
</script>

<template>
  
    <div class="wrapper" id="login-wrapper">
      <section class="login">
         <form v-on:submit.prevent="handleLoginFormSubmit()">
           <div class="form-group">
              <lable> Email address</lable>
              <input 
              class="form-control"
              palceholder= "Enter your email address"
              type="text"
              v-model="login.email"
              >
            </div>
            <div class="form-group">
              <lable> password</lable>
              <input 
                class="form-control"
                palceholder= "Enter your password"
                type="password"
                v-model="login.password"
              >
            </div>
          <button >Login</button>
         </form>
      </section>
    </div>
  
</template>

<style>

</style>
