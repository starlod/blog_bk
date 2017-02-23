<template>
    <div id="images">
        <image_uploader v-on:onUploaded="load"></image_uploader>
        <table class="table table-striped table-hover" v-if="images.length > 0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>url</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="image in images">
                    <td>{{ image.id }}</td>
                    <td>{{ image.name }}</td>
                    <td><a :href="image.url" target="_blank"><img :src="image.url" :alt="image.name" width="75" height="75"></a></td>
                </tr>
            </tbody>
        </table>
        <p v-else>画像がありません。</p>

        <pagination></pagination>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                images: []
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            load: function() {
                var self = this;
                api.get('/images').then(function (response) {
                    self.images = JSON.parse(response.request.responseText);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
