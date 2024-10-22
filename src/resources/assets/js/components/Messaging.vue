<template>
  <div id="chat-box" @scroll="onScroll">
    <div v-for="message in messages" :key="message.id" class="message">
      <p>{{ message.author }}: {{ message.text }}</p>
      <span>{{ message.time }}</span>
    </div>
    <div v-if="loading" class="loading">
      <p>Loading more messages...</p>
    </div>
  </div>

  <select v-model="selectedPhoneNumber">
    <option v-for="number in phoneNumbers" :key="number" :value="number">
      {{ number }}
    </option>
  </select>

  <input v-model="newMessage" placeholder="Type your message">
  <button @click="sendMessage">Send</button>
</template>

<script>
export default {
  data() {
    return {
      messages: [],  // Масив для зберігання повідомлень
      loading: false,
      page: 1,       // Номер сторінки для завантаження
      perPage: 15,   // Кількість повідомлень на сторінці
      newMessage: '', // Нове повідомлення
      selectedPhoneNumber: '',
      phoneNumbers: []  // Номери телефону пацієнта
    };
  },
  mounted() {
    this.loadMessages();
    this.fetchPhoneNumbers();
  },
  methods: {
    // Завантаження повідомлень
    loadMessages() {
      if (this.loading) return;

      this.loading = true;
      axios.get('/api/messages', {
        params: { page: this.page, perPage: this.perPage }
      }).then(response => {
        this.messages = [...response.data.messages, ...this.messages];
        this.page += 1;
        this.loading = false;
      });
    },
    
    // Завантажити номери телефону пацієнта
    fetchPhoneNumbers() {
      axios.get('/api/patient-phone-numbers').then(response => {
        this.phoneNumbers = response.data;
        this.selectedPhoneNumber = this.phoneNumbers[0];  // Вибираємо перший номер за замовчуванням
      });
    },
    
    // Відправка нового повідомлення
    sendMessage() {
      axios.post('/api/messages', {
        message: this.newMessage,
        phone_number: this.selectedPhoneNumber
      }).then(response => {
        this.messages.push(response.data);
        this.newMessage = '';
      });
    },
    
    // Пагінація при прокручуванні чату
    onScroll(event) {
      const element = event.target;
      if (element.scrollTop === 0 && !this.loading) {
        this.loadMessages();
      }
    }
  }
}
</script>

<style scoped>
#chat-box {
  height: 400px;
  overflow-y: scroll;
}

.message {
  padding: 10px;
  border-bottom: 1px solid #ccc;
}

.loading {
  text-align: center;
  padding: 10px;
}
</style>