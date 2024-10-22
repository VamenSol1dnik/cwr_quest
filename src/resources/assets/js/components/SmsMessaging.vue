<template>
  <div>
    <h2>SMS</h2>
    <ul>
      <li v-for="message in smsMessages" :key="message.id">{{ message.text }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      smsMessages: []
    };
  },
  created() {
    this.loadSMSMessages();
  },
  methods: {
    loadSMSMessages() {
      
      axios.get('/api/sms-messages')
        .then(response => {
          this.smsMessages = response.data;
        })
        .catch(error => {
          console.error("Помилка при завантаженні SMS:", error);
        });
    }
  }
}
</script>