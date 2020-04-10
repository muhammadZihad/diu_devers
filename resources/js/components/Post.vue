<template>
  <div>
    <div v-for="(post) in lists" :key="post.id" class="row post mb-2 p-2">
      <div class="col-12 flex-column">
        <div class="d-flex">
          <div class="img img-responsive rounded-circle d-img mr-2">
            <img class="a-img" v-bind:src="post.user.avatar" alt />
          </div>
          <div class="d-flex align-items-center">
            <div class="d-flex flex-column">
              <h5 class="h5 text-custom m-0">
                <a :href="post.user.slug">
                  {{
                  post.user.name
                  }}
                </a>
              </h5>
              <p class="small m-0">{{ post.created_at }}</p>
            </div>
          </div>
        </div>
        <p>{{ post.content }}</p>
        <div
          v-if="post.avatar !== 'http://devers.test/storage/none' && post.avatar !== 'http://devers.test/storage/'"
          class="row justify-content-center"
        >
          <div class="col-8">
            <div class="post-img">
              <img v-bind:src="post.avatar" alt class="a-img" />
            </div>
          </div>
        </div>
        <div v-if="post.link !=='null'" class="row p-2">
          <div class="col-12 d-flex b1 p-2">
            <div class="d-flex align-items-center">
              <div class="link-img-box"></div>
            </div>
            <div class="link-details ml-2">
              <h4 class="h5 text-custom">
                <a href="#">github/muhammadZihad</a>
              </h4>
              <p class="m-0 text-muted">
                Lorem, ipsum dolor sit amet consectetur
                adipisicing elit. Non fuga quos optio corrupti
                voluptas itaque aut quisquam sit mollitia
                asperiores.
              </p>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 p-2 d-flex align-items-center">
            <button
              v-bind:class="{'bg text-white':post.like}"
              class="btn-sm nr b-like mr-2 py-1 px-4"
              @click="likeme(post)"
            >
              <i class="fas fa-thumbs-up"></i>
            </button>
            <button
              v-bind:class="{'bg text-white':post.love}"
              class="btn-sm nr b-clap mr-2 py-1 px-4"
              @click="loveme(post)"
            >
              <i class="fas fa-heart"></i>
            </button>
            <a href="#" v-if="post.count===0">Be the first to react</a>
            <a href="#" v-else>{{post.count }} {{ post.count===1? ' reaction':' reactions'}}</a>
          </div>
        </div>
      </div>
    </div>
    <button
      v-if="more"
      class="btn btn-light btn-sm btn-block text-center"
      @click="loadmore(next)"
    >Load more</button>
  </div>
</template>

<script>
export default {
  props: ["uid"],
  data() {
    return {
      lists: [],
      cache: [],
      more: false,
      next: ""
    };
  },
  mounted() {
    this.getFriends();
  },
  methods: {
    getFriends() {
      axios.get("/post").then(response => {
        let lists = response.data.data;
        if (response.data.next_page_url) {
          this.next = response.data.next_page_url;
          this.more = true;
        }
        for (let f = 0; f < lists.length; f++) {
          lists[f].like = false;
          lists[f].love = false;
          lists[f].count = lists[f].likes.length;
          for (let e = 0; e < lists[f].likes.length; e++) {
            if (lists[f].likes[e].user_id === this.uid) {
              if (lists[f].likes[e].type == 1) {
                lists[f].like = true;
              } else {
                lists[f].love = true;
              }
            }
          }
        }
        this.lists = lists;
      });
    },
    likeme(post) {
      if (post.like === false) {
        axios.get("/like/" + post.id + "/1").then(res => {
          if (res.data == "success") {
            post.like = !post.like;
            post.count++;
          }
        });
      } else {
        axios.get("/unlike/" + post.id + "/1").then(res => {
          if (res.data == "success") {
            post.like = !post.like;
            post.count--;
          }
        });
      }
    },
    loveme(post) {
      if (post.love === false) {
        axios.get("/like/" + post.id + "/0").then(res => {
          if (res.data == "success") {
            post.love = !post.love;
            post.count++;
          }
        });
      } else {
        axios.get("/unlike/" + post.id + "/0").then(res => {
          if (res.data == "success") {
            post.love = !post.love;
            post.count--;
          }
        });
      }
    },
    react(post) {
      if (post.count === 0) {
        return "Be the first liker";
      }
      let x = post.count + 1;
      return x + " people reacted";
    },
    loadmore(url) {
      axios.get(url).then(response => {
        let lists = response.data.data;
        if (response.data.next_page_url) {
          this.next = response.data.next_page_url;
          this.more = true;
        } else {
          this.more = false;
        }
        for (let f = 0; f < lists.length; f++) {
          lists[f].like = false;
          lists[f].love = false;
          lists[f].count = lists[f].likes.length;
          for (let e = 0; e < lists[f].likes.length; e++) {
            if (lists[f].likes[e].user_id === this.uid) {
              if (lists[f].likes[e].type == 1) {
                lists[f].like = true;
              } else {
                lists[f].love = true;
              }
            }
          }
        }
        this.lists = this.lists.concat(lists);
      });
    }
  }
};
</script>
