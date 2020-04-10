<template>
  <div>
    <div class="form-inline my-2 my-lg-0 par">
      <input
        v-model="key"
        @focus="active=true"
        @blur="active=false"
        v-on:keyup="getRequests()"
        class="form-control mr-sm-2"
        type="search"
        placeholder="Search"
        aria-label="Search"
      />
      <button @click="getRequests()" class="btn btn-outline-success my-2 my-sm-0 nr">
        <i class="fas fa-search"></i>
      </button>
    </div>
    <div class="list-group parc" :class="{'d-n':active}">
      <a
        v-for="item in lists"
        :key="item.id"
        :href="item.slug"
        class="list-group-item list-group-item-action d-flex align-items-center"
      >
        <div class="d-img mr-2">
          <img :src="item.avatar" alt class="a-img" />
        </div>
        <h5 class="text-custom">{{item.name}}</h5>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      lists: [],
      key: "",
      active: false,
      count: false
    };
  },
  methods: {
    getRequests() {
      axios.get("/searcher/" + this.key).then(res => {
        this.lists = res.data.data;
      });
    }
  }
};
</script>