<template>
  <div class="chat">
    <Contacts></Contacts>
    <attachment></attachment>
  </div>
</template>

<script>
import Attachment from "@/components/Chat/Attachment.vue";
import Contacts from "@/components/Chat/Contact.vue";
export default {
  components: {
    Contacts,
    Attachment,
  },
};
</script>

<style lang="scss" scoped>
.chat {
  display: flex;
  justify-content: space-between;
  align-items: stretch;
  position: relative;
  overflow: hidden;
}
</style>
