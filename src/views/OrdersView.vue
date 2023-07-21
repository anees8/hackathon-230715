<script setup>
import { storeToRefs } from "pinia";

import { useOrdersStore } from "../stores/orders.js";
const {
  orders,
  order,
  fields,
  modal,
  isBusy,
  errors,
  options,
  perPage,
  currentPage,
  rows
} = storeToRefs(useOrdersStore());

const {
  getOrders,
  dateTime,
  setPerPage,
  uploadData,
  editOrder,
  deleteOrder,
  hideModel
} = useOrdersStore();

getOrders();
</script>
<template>
  <b-container fluid>
    <b-row>
      <b-card>
        <b-col>
          <b-row align-v="center">
            <b-col><h5>Orders List</h5></b-col>
            <b-col>
              <b-button
              size="sm"
                @click="modal = !modal"
                class="float-end"
                pill
                variant="outline-dark"
              >
                <FontAwesomeIcon icon="plus" class="me-2" />Add Order</b-button
              >
              <div>
                <b-modal
                  v-model="modal"
                  :title="
                    order.id ? 'Update Order' : 'Add Order'
                  "
                  hide-header-close
                  no-close-on-backdrop
                >
                  <BFormGroup
                    id="input-group-1"
                    label="Order Qty:"
                    label-for="input-1"
                  >
                    <BFormInput
                      id="input-1"
                      v-model="order.quatity"
                      :class="errors && errors.quatity ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="text"
                      placeholder="Enter Order Qty"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.quantity">{{
                      errors.quantity[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>

                  <template #footer>
                    <div>
                      <button class="btn btn-outline-dark" @click="hideModel">
                        Close
                      </button>
                    </div>
                    <div>
                      <button
                        class="btn btn-outline-primary"
                        @click="uploadData"
                      >
                        {{
                          order.id
                            ? "Update Order"
                            : "Add Order"
                        }}
                      </button>
                    </div>
                  </template>
                </b-modal>
              </div></b-col
            >
          </b-row>
        </b-col>
        <b-col
          ><b-table
            striped
            outlined
            empty-filtered-text
            caption-top
            hover
            small
            footClone
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
            }}) </template>
            
         
            
            <template #cell(product_type)="data">{{
              data.item.sku.product_type.name
            }}</template>
            <template #cell(product_size)="data">{{
              data.item.sku.size.name
            }}</template>
            <template #cell(price)="data">{{
              data.item.sku.price
            }}</template>
            <template #cell(cart_value)="data">{{
                data.item.sku.price*data.item.quantity
            }}</template>
            <template #cell(created_at)="data">{{
              dateTime(data.item.created_at)
            }}</template>
            <template #cell(actions)="data">
              <b-button
              size="sm"
                class="rounded-circle p-2 me-2"
                @click="editOrder(data.item.id)"
                variant="outline-success"
              >
                <FontAwesomeIcon icon="pen" />
              </b-button>

              <b-button
              size="sm"
                class="rounded-circle p-2 me-2"
                @click="deleteOrder(data.item.id)"
                variant="outline-danger"
              >
                <FontAwesomeIcon icon="fa-regular fa-trash-alt" />
              </b-button>
            </template> </b-table
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
              v-on:click="getOrders"
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
