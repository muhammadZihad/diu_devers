<template>
  <div></div>
</template>

<script>
export default {
  mounted() {
    this.listen();
  },
  props: ["myid"],
  methods: {
    listen() {
      Echo.private("App.User." + this.myid).notification(noty => {
        alert("new notification");
        console.log(noty);
      });
    }
  }
};
</script>