<template>
  <div class="form-group d-flex">
    <button
      v-if="status===1"
      @click="cancel_request()"
      class="btn form-control nb text-white btn-danger"
    >Cancel Request</button>
    <button
      class="btn form-control nb bg-custom text-white"
      v-else-if="status===2"
      @click="accept_request()"
    >Accept</button>
    <button
      v-else-if="status===-1"
      @click="add_friend()"
      class="btn form-control nb text-white bg-custom"
    >Add me</button>
    <button
      v-else-if="status===0"
      @click="unfriend()"
      class="btn btn-secondary form-control nb"
    >Unfriend</button>
    <button
      v-if="status===2"
      @click="cancel_request()"
      class="btn form-control nb btn-danger text-white"
    >Cancel</button>
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
