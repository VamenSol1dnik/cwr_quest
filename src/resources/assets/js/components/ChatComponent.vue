<template>
  <div>
    <select v-model="selectedPhone">
      <option v-for="(phone, index) in phones" :key="index" :value="phone">
        {{ phone }}
      </option>
    </select>

    <div class="messages">
      <message-component
        v-for="message in messages"
        :key="message.id"
        :message="message"
        :is-own="message.direction === 'outbound'"
      />
    </div>

    <input v-model="newMessage" placeholder="Type a message..." />
    <button @click="sendMessage">Send</button>
  </div>
</template>

<script>
import MessageComponent from './MessageComponent.vue'; // Імпортуємо MessageComponent

export default {
  data() {
    return {
      messages: [],
      newMessage: '',
      selectedPhone: '',
      phones: [(661)-444-3684, (818)-538-1195, (805)-329-5300]
    };
  },
  components: {
    MessageComponent
  },
  created() {
    this.loadPhones();
    this.loadMessages();
  },
  methods: {
    loadPhones() {
      axios.get(`/api/patients/${this.$route.params.patient_id}/phones`)
        .then(response => {
          this.phones = Object.values(response.data);
          this.selectedPhone = this.phones[0];
        });
    },
    loadMessages() {
      axios.get(`/api/patients/${this.$route.params.patient_id}/messages`)
        .then(response => {
          this.messages = response.data.data;
        });
    },
    sendMessage() {
      axios.post('/api/messages', {
        patient_id: this.$route.params.patient_id,
        number_from: this.selectedPhone,
        number_to: 'CompanyNumber', // номер компанії
        message_text: this.newMessage
      }).then(response => {
        this.messages.unshift(response.data);
        this.newMessage = '';
      });
    }
  }
};
</script>

<style scoped>
.messages {
  max-height: 500px;
  overflow-y: auto;
}
</style>