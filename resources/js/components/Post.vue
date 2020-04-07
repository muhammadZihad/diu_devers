<template>
    <div>
        <div
            v-for="(post, index) in lists"
            :key="post.id"
            class="row post mb-2 p-2"
        >
            <div class="col-12 flex-column">
                <div class="d-flex">
                    <div
                        class="img img-responsive rounded-circle d-img mr-2"
                    ></div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h5 class="h5 text-custom m-0">
                                <a :href="post.user.slug">{{
                                    post.user.name
                                }}</a>
                            </h5>
                            <p class="small m-0">{{ post.created_at }}</p>
                        </div>
                    </div>
                </div>
                <p>
                    <span v-if="!readmore"
                        >{{ post.content.slice(0, 100) }}
                    </span>
                    <a
                        class=""
                        v-if="!readmore"
                        @click="readmore = !readmore"
                        href="#"
                    >
                        read more..
                    </a>
                    <span v-else>{{ post.content }}</span>
                </p>
                <div v-if="post.img" class="row justify-content-center">
                    <div class="col-8">
                        <div class="post-img"></div>
                    </div>
                </div>
                <div v-if="post.link" class="row p-2">
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
                <div class="row">
                    <div class="col-6 p-2">
                        <button class="btn-sm nr b-like">Like</button>
                        <button class="btn-sm nr b-clap bg">Claped</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            lists: [],
            cache: [],
            more: false,
            readmore: false,
            next: "",
            stop: false,
        };
    },
    mounted() {
        this.getFriends();
    },
    methods: {
        getFriends() {
            axios.get("/post").then((response) => {
                this.lists = response.data.data;
            });
        },
    },
};
</script>
