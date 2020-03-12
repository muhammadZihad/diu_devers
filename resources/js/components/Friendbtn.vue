<template>
  <div>
    <button class="btn btn-sm btn-warning float-right">Follow</button>
  </div>
</template>

<script>
export default {
  mounted() {
    // this.$http.get("/friend_status/" + this.user_id).then(res => {
    //   console.log(res);
    // });

    axios.get("/friend_status/" + this.user_id).then(response => {
      console.log(response);
    });
  },
  props: ["user_id"]
};
</script>
