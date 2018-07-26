<template>
    <div>
        <nav>
            <ul class="pagination">
                <li :class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchPosts(pagination.prev_page_url)">
                        Previous
                    </a>
                </li>
                <li class="page-item disabled"><p class="page-link text-dark">
                    Page {{ pagination.current_page }} of {{ pagination.last_page }}
                </p></li>
                <li :class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchPosts(pagination.next_page_url)">
                        Next
                    </a>
                </li>
            </ul>
        </nav>

        <button class="btn btn-secondary mb-3 form-control w-75" @click="toggleForm">Форма</button>

        <div class="mb-3 w-75" v-show="visibleForm">
            <div class="form-group">
                <input type="text" v-model="post.title" placeholder="Title" class="form-control">
            </div>
            <div class="form-group">
                <textarea v-model="post.summary" class="form-control" placeholder="Summary"></textarea>
            </div>
            <div class="form-group">
                <textarea v-model="post.body" rows="7" class="form-control" placeholder="Body"></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="thumbnail" @change="addImage" class="form-control">
            </div>
            <button class="btn btn-outline-dark w-100" v-if="!edit" @click="addPost">Create new post</button>
            <button class="btn btn-outline-dark w-100" v-if="edit" @click="updatePost">Update this post</button>
        </div>
        <template>
        <div class="card mb-4 w-75" v-for="(post, index) in posts" :key="post.id">
            <img class="card-img-top" :src="post.thumbnail">
            <div class="card-body">
                <h3 class="card-title text-center">{{ post.title }}</h3>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{ post.summary }}</li>
                <li class="list-group-item">{{ post.body }}</li>
            </ul>
            <div class="card-body" style="display: flex; justify-content: space-between">
                <button @click="editPost(post)" class="btn btn-primary">Edit</button>
                <button @click="deletePost(post.id, index)" class="btn btn-danger">Delete</button>
            </div>
        </div>
        </template>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: [],
                post: {
                    title: '',
                    summary: '',
                    dody: '',
                    thumbnail: null
                },
                post_id: '',
                edit: false,
                pagination: {},
                visibleForm: false,
            }
        },

        created() {
            this.fetchPosts();
        },

        methods: {
            toggleForm() {
                this.visibleForm = !this.visibleForm
            },
            fetchPosts(page_url) {
                page_url = page_url || 'api/admin/posts';
                axios.get(page_url)
                    .then(response => {
                        this.posts = response.data.data;
                        this.makePagination(response.data.meta, response.data.links)
                    })
                    .catch(error => console.log(error))
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },
            deletePost(id, index) {
                axios.delete('api/admin/posts/' + id + '/delete')
                    .then(response => {
                        this.posts.splice(index, 1);
                    });
            },
            addImage(event) {
                this.post.thumbnail = event.target.files[0];
            },

            addPost() {
                let formData = new FormData;

                for (let item in this.post) {
                    formData.append(item, this.post[item])
                }
                axios.post('api/admin/posts/store', formData)
                    .then(response => {
                        this.post.title = '';
                        this.post.summary = '';
                        this.post.body = '';
                        this.thumbnail = null;
                        this.visibleForm = false;
                        this.posts.unshift(response.data.data)
                    })
                    .catch(error => console.log(error))
            },
            editPost(post) {
                document.body.scrollTop = document.documentElement.scrollTop = 0;
                this.post_id = post.id;
                this.post.title = post.title;
                this.post.summary = post.summary;
                this.post.body = post.body;
                this.edit = true;
                this.visibleForm = true;
            },
            updatePost() {
                let formData = new FormData();

                for (let item in this.post) {
                    formData.append(item, this.post[item])
                }
                axios.post('api/admin/posts/' + this.post_id + '/update', formData)
                    .then(response => {
                        this.post.title = '';
                        this.post.summary = '';
                        this.post.body = '';
                        this.thumbnail = null;
                        this.post_id = '';
                        this.edit = false;
                        this.visibleForm = false;
                        this.fetchPosts();
                    })
                    .catch(error => console.log(error))
            }

        }

    }
</script>