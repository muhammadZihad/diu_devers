<template>
  <div>
    <ul class="list-group list-group-flush">
      <li v-if="stop" class="list-group-item text-center">No requests</li>
      <li v-else class="list-group-item p-0 mb-2 nb" v-for="(item, index) in lists" :key="item.id">
        <div class="media-body d-flex align-items-center">
          <div class="img rounded-circle d-img mr-2">
            <img class="a-img" v-bind:src="item.avatar" alt />
          </div>
          <div class="item">
            <h5 class="mt-0 mb-1">
              <a :href="item.slug" class="text-custom">{{ item.name }}</a>
            </h5>
            <div class="d-flex">
              <button
                @click="accept_request(item.id,index)"
                class="btn btn-sm btn-success bg-custom text-white nr"
              >
                <i class="fas fa-check-circle"></i> Accept
              </button>
              <button
                @click="cancel_request(item.id,index)"
                class="btn btn-sm btn-danger text-white nr"
              >
                <i class="fas fa-times-circle"></i> Cancel
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
  props: ["myid"],
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
      axios.get("/friend_requests/" + this.myid).then(response => {
        let datam = response.data.data;
        // if (this.cache.length === datam.length + 1) {
        this.lists = response.data.data;
        // } else {
        //   this.lists = this.cache;
        // }
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
    accept_request(id, index) {
      axios.get("/accept_request/" + id).then(response => {
        if (response.data === "ok") {
          //   this.getRequests();
          this.lists.splice(index, 1);
          this.check_list();
        }
      });
    },
    cancel_request(id, index) {
      axios.get("/cancel_request/" + id).then(response => {
        if (response.data === "ok") {
          this.getRequests();
        }
      });
    },
    check_list() {
      console.log(this.lists);
      if (this.lists.length === 0) {
        this.stop = true;
      }
    }
  }
};
</script>