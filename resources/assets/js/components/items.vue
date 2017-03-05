<template>
    <div id="items">
        <posts :items="items" v-if="url === '/posts'"></posts>
        <images :items="items" v-if="url === '/images'"></images>
        <gallery :items="items" v-if="url === '/gallery'"></gallery>

        <pagination :pagination="pagination"></pagination>
    </div>
</template>

<script>
    export default {
        props: {
            url: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                items: [],
                pagination: {
                    current_page: 1,
                    last_page: 0
                }
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            load(page = 1) {
                var self = this;

                if (this.pagination.last_page !== 0 && page > this.pagination.last_page) {
                    return false;
                } else if (page < 1) {
                    return false;
                }

                api.get(this.url, {
                    params: {
                        page: page
                    }
                }).then(function (response) {
                    let json = JSON.parse(response.request.responseText);
                    self.items = json.data;
                    self.makePagination(json);
                }).catch(function (error) {
                    console.error(error);
                });
            },
            reload() {
                this.load(this.pagination.current_page);
                d('reload');
            },
            autoReload() {
                var self = this;
                setInterval(function() {
                    self.reload();
                }, 15000);
            },
            makePagination(json) {
                this.pagination.current_page = json.current_page;
                this.pagination.last_page = json.last_page;
            }
        }
    }
</script>
