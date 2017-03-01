<template>
    <nav>
        <ul class="pagination" v-if="pagination.last_page > 1">
            <li class="disabled">
                <span>
                    {{ pagination.current_page }}/{{ pagination.last_page }}
                </span>
            </li>
            <li :class="pagination.current_page === 1 ? 'disabled' : ''" v-if="pagination.last_page > 2">
                <a @click="load(1)" aria-label="最初のページへ">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                </a>
            </li>
            <li :class="pagination.current_page === 1 ? 'disabled' : ''">
                <a @click="load(pagination.current_page - 1)" aria-label="前のページへ">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            </li>
            <li v-for="n in pagination.last_page"
                :class="n === pagination.current_page ? 'active' : ''">
                <a @click="load(n)">{{ n }}</a>
            </li>
            <li :class="pagination.current_page === pagination.last_page ? 'disabled' : ''">
                <a @click="load(pagination.current_page + 1)" aria-label="次のページへ">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </li>
            <li :class="pagination.current_page === pagination.last_page ? 'disabled' : ''" v-if="pagination.last_page > 2">
                <a @click="load(pagination.last_page)" aria-label="最後のページへ">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>

    export default {
        props: {
            pagination: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {

            }
        },
        mounted() {
        },
        computed: {
        },
        methods: {
            load(page) {
                this.$parent.load(page);
            },
            isActive(n) {
                return n === pagination.current_page;
            }
        }
    }
</script>
