<template>
  <div :class="{ 'own-message': isOwn, 'other-message': !isOwn }">
    <span><strong>{{ message.author_name }}</strong></span>
    <span>{{ message.message_text }}</span>
    <span>{{ message.created_at | formatTime }}</span>
  </div>
</template>

<script>
export default {
  props: ['message', 'isOwn'],
  filters: {
    formatTime(value) {
      const date = new Date(value);
      return date.getHours() + ':' + date.getMinutes();
    }
  }
};
</script>

<style scoped>
.own-message {
  text-align: right;
  background-color: #DCF8C6;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 10px;
}

.other-message {
  text-align: left;
  background-color: #FFF;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 10px;
}
</style>