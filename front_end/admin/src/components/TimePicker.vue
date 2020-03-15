<template>
  <div id="app">
        <el-time-picker
            is-range
            v-model="value1"
            range-separator="至"
            start-placeholder="开始时间"
            end-placeholder="结束时间"
            placeholder="选择时间范围">
        </el-time-picker>
  </div>
</template>

<script>
    export default {
        data() {
        return {
            value1: [new Date(2020, 3, 15, 0, 0), new Date(2020, 3, 15, 23, 59)]
        }
        }
    }
</script>

<style scoped>

</style>
