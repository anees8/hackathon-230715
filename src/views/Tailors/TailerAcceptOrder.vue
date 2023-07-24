<script setup>
import { storeToRefs } from "pinia";
import { useRoute } from 'vue-router';
import { useTailorAcceptedOrdersStore } from "../../stores/acceptedOrder";
const {
  orders,
  fields,
  isBusy,
  errors,
  options,
  perPage,
  currentPage,
  rows
} = storeToRefs(useTailorAcceptedOrdersStore());

const {
  getOrders,
  setPerPage,
  acceptOrder
} = useTailorAcceptedOrdersStore();

const route = useRoute();
const tailorID=parseInt(route.params.id);
getOrders(tailorID);
</script>
<template>
  <b-container fluid>
    <b-row>
      <b-card>
        <b-col>
          <b-row align-v="center">
            <b-col><h5>Accepted Orders List - ( TOTAL : {{ rows??0 }})</h5></b-col>
          </b-row>
        </b-col>
        <b-col
          ><b-table
            striped
            outlined
            empty-filtered-text
            caption-top
            hover
            footClone
            small
           :items="orders"
            :fields="fields"
            :busy="isBusy"
            responsive
            show-empty
          >
             <template #cell(product_id)="data">{{
            data.item.sku.name
            }} - ({{
           (data.item.sku.sku_code)
            }})</template>
            <template #cell(product_type)="data">{{
              data.item.sku.product_type.name
            }}</template>
            <template #cell(product_size)="data">{{
              data.item.sku.size.name
            }}</template>
            <template #cell(qty)="data">{{
              data.item.quantity
            }}</template>
            <template #cell(commission)="data">{{
           Math.floor(((data.item.sku.price)*(1/6)),2)
            }}</template>
            <template #cell(total_commission)="data">{{
              data.item.quantity * Math.floor(((data.item.sku.price)*(1/6)),2)
            }}</template>
           
        </b-table
        ></b-col>
        <b-row align-h="end" class="mt-5">
          <b-col xl="1" lg="2" md="2" class="p-2">
            <b-form-select
              v-if="rows > 5"
              v-model="perPage"
              :options="options"
              size="md"
              v-on:change="setPerPage"
              varient="dark"
            ></b-form-select>

          </b-col>

         
          <b-col xl="5" lg="6" md="8" class="p-2">
            <b-pagination
              v-if="rows / perPage > 1"
              v-on:click="getOrders(tailorID)"
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
            ></b-pagination>
          </b-col>
        </b-row>
      </b-card>
    </b-row>
  </b-container>
</template>
