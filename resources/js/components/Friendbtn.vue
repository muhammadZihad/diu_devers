<template>
  <div class="float-right">
    <button v-if="status===1" @click="cancel_request()" class="btn btn-sm btn-danger">Cancel Request</button>
    <button
      v-else-if="status===2"
      @click="accept_request()"
      class="btn btn-sm btn-info"
    >Accept Request</button>
    <button v-else-if="status===-1" @click="add_friend()" class="btn btn-sm btn-success">+Add friend</button>
    <button
      v-else-if="status===0"
      @click="unfriend()"
      class="btn btn-sm btn-secondary float-right"
    >Unfriend</button>
    <button v-if="status===2" @click="cancel_request()" class="btn btn-sm btn-danger">Cancel</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      status: -5
    };
  },
  mounted() {
    axios.get("/friend_status/" + this.user_id).then(response => {
      this.status = response.data;
    });
  },
  props: ["user_id"],
  methods: {
    accept_request() {
      axios.get("/accept_request/" + this.user_id).then(response => {
        if (response.data === "ok") {
          this.status = 0;
        }
      });
    },
    add_friend() {
      axios.get("/add_friend/" + this.user_id).then(response => {
        if (response.data === "ok") {
          this.status = 1;
        }
      });
    },
    unfriend() {
      axios.get("/unfriend/" + this.user_id).then(response => {
        if (response.data === "ok") {
          this.status = -1;
        }
      });
    },
    cancel_request() {
      axios.get("/cancel_request/" + this.user_id).then(response => {
        if (response.data === "ok") {
          this.status = -1;
        }
      });
    }
  }
};
</script>
