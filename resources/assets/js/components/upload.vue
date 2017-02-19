<template>
    <div>
        <div id="drop-box" class="drop-box"
             v-bind:class="{ dragging: isDragging }"
             @dragleave="onDragLeave"
             @dragover="onDragOver"
             @drop="onDrop"
             @dragend="onDragEnd">
            <div class="drag-drop-inside">
                <p class="drag-drop-info">ここにファイルをドロップ</p>
                <p>または</p>
                <p class="drag-drop-buttons">
                    <input id="plupload-browse-button" type="button" value="ファイルを選択" class="btn btn-default" style="position: relative; z-index: 1;">
                </p>
            </div>
            <input type="file" class="hide" id="files" name="files" multiple>
        </div>
        <p>最大アップロードサイズ: 20MB</p>
        <ul>
            <li v-for="(item, index) in items">
                <b>{{ item.name }}</b> {{ item.size|separate }} bytes.
            </li>
        </ul>
    </div>
</template>

<style lang="css">

.drop-box {
    position: relative;
    background-color: #f5f5f5;
    border: 4px dashed #b4b9be;
    border-radius: 10px;
    width: 100%;
    height: 200px;
}
.dragging {
    border-color: #1aa;
}
.drag-drop-inside {
    position: absolute;
    width: 400px;
    height: 120px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}
.drag-drop-inside p {
    text-align: center;
}

</style>

<script>
    export default {
        data() {
            return {
                items: [],
                isDragging: false
            }
        },
        mounted() {
            var self = this

            if (!window.FileReader) {
                alert("File API がサポートされていません。");
            }
        },
        methods: {
            onDragLeave: function(e) {
                console.log('onDragLeave')
                this.isDragging = false;
            },
            onDragOver: function(e) {
                console.log('onDragOver')
                e.stopPropagation();
                e.preventDefault();
                e.dataTransfer.dropEffect = 'copy';
                this.isDragging = true;
            },
            onDrop: function(e) {
                console.log('onDrop')
                e.preventDefault();
                var self = this

                _.forEach(e.dataTransfer.files, function(file, key) {
                    console.log(file.name);
                    self.items.push(file);
                    var fileReader = new FileReader();
                    fileReader.onload = function(event) {
                        // var dropBox = document.getElementById('#drop-box');
                        // // event.target.result に読み込んだファイルの内容が入っています.
                        // // ドラッグ＆ドロップでファイルアップロードする場合は result の内容を Ajax でサーバに送信しましょう!
                        // $("#droppable").text("[" + file.name + "]" + event.target.result);
                        api.post('/images').then(function (response) {
                            file: event.target.result
                        }).then(function (response) {
                            console.log(response);
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                    fileReader.readAsDataURL(file);
                });


                // var file = e.dataTransfer.files[0];
                // console.log(file);
            },
            onDragEnd: function(e) {
                console.log('onDragEnd')
                e.preventDefault();
            }
        },
    }
</script>
