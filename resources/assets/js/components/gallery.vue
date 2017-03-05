<template>
    <div id="gallery">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thumbnail Gallery</h1>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6" v-for="item in items" v-if="items.length > 0">
                <a class="thumbnail" href="#">
                    <img :src="item.url" :alt="item.name">
                </a>
            </div>
            <div class="col-lg-12" v-else>
                <p>画像がありません。</p>
            </div>
        </div>
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
            }
        }
    }
</script>
