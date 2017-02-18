<script>
  import {mapState} from 'vuex'
  export default {
    computed: {
      ...mapState({
        pmStore: state => state.privateMessageStore
      })
    },
    created () {
      this.$store.dispatch('setUserMessagesRec')
    }

  }
</script>

<template>
  <div>
    <section class="header">
      <h1>private Message</h1>
      <ul>
        <li v-for="message in pmStore.messagesRec" v-bind:class="[message.read = 0 ? 'unread' : 'read']">
        {{message.sender.name}}
        {{message.subject}}
        {{message.created_at}}
        </li>
      </ul>
    </section>
  </div>
</template>
