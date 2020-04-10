<template>
  <div>
    <ul class="list-group list-group-flush">
      <li v-if="stop" class="list-group-item text-center">No friends</li>

      <li v-else class="list-group-item nb p-0 mb-2" v-for="(item, index) in lists" :key="item.id">
        <div class="media-body d-flex">
          <div class="rounded-circle d-img mr-2">
            <img class="a-img" v-bind:src="item.avatar" alt />
          </div>
          <div class="media-content">
            <h5 class="mt-0 mb-1">
              <a :href="item.slug" class="text-custom">{{ item.name }}</a>
            </h5>
            <div class="d-flex">
              <button @click="unfriend(item.id,index)" class="btn btn-sm btn-danger text-white nr">
                <i class="fas fa-times-circle text-white"></i> Unfriend
              </button>
            </div>
          </div>
        </div>
      </li>
      <button class="btn btn-sm btn-light" v-if="more" @click="loadmore(next)">see more</button>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      lists: [],
      cache: [],
      more: false,
      next: "",
      stop: false
    };
  },
  mounted() {
    this.getRequests();
  },
  methods: {
    getRequests() {
      //   this.cache = this.lists;
      axios.get("/friends_paginate").then(response => {
        let datam = response.data.data;
        this.lists = response.data.data;
        this.more = response.data.more;
        this.next = response.data.next;
        this.check_list();
      });
    },
    loadmore(nextUrl) {
      axios.get(nextUrl).then(response => {
        let datas = response.data.data;
        datas.forEach(element => {
          this.lists.push(element);
        });
        this.more = response.data.more;
        this.next = response.data.next;
      });
    },
    unfriend(id, index) {
      axios.get("/cancel_request/" + id).then(response => {
        if (response.data === "ok") {
          this.lists.splice(index, 1);
        }
        this.check_list();
      });
    },
    check_list() {
      if (this.lists.length === 0) {
        this.stop = true;
      }
    }
  }
};
</script>