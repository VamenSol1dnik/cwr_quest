<template>
  <div class="sms-chat">
    <h3>SMS Чат</h3>
    <div class="messages">
      <div v-for="message in messages" :key="message.id">
        <div :class="{'my-message': message.isMyMessage, 'other-message': !message.isMyMessage}">
          <p><strong>{{ message.author }}</strong></p>
          <p>{{ message.text }}</p>
          <p>{{ message.time }}</p>
        </div>
      </div>
    </div>
    <div class="message-input">
      <input v-model="newMessage" placeholder="Введіть ваше повідомлення">
      <button @click="sendMessage">Надіслати</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      messages: [], // Список повідомлень
      newMessage: '', // Поле для нового повідомлення
    };
  },
  methods: {
    sendMessage() {
      // Логіка відправки повідомлення
    },
  },
};
</script>

<style scoped>
/* Додаємо стилі для повідомлень */
.my-message {
  text-align: right;
}
.other-message {
  text-align: left;
}
</style>