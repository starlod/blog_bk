<template>
    <div id="images">
        <image_uploader @onUploaded="reload"></image_uploader>
        <table class="table table-striped table-hover" v-if="items.length > 0">
            <thead>
                <tr>
                    <th width="100">id</th>
                    <th width="100">url</th>
                    <th>name</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items">
                    <td>{{ item.id }}</td>
                    <td><img @click="showModal = true" :src="item.url" :alt="item.name" width="75" height="75"></td>
                    <td>{{ item.name }}</td>
                    <td>
                        <button class="btn btn-danger">削除</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <p v-else>画像がありません。</p>

        <lightbox v-if="showModal" @close="showModal = false">
            <h3 slot="header">custom header</h3>
        </lightbox>

    </div>
</template>

<script>
    export default {
        props: {
            items: {
                type: Array,
                required: true,
            }
        },
        data() {
            return {
                showModal: false
            }
        },
        mounted() {
            this.$parent.autoReload();
        },
        methods: {
            reload() {
                this.$parent.reload();
            },
            destroy(id) {
                var self = this;
                api.delete('/images/' + id).then(function (response) {
                    self.reload();
                }).catch(function (error) {
                    console.error(error);
                });
            }
        }
    }
</script>
