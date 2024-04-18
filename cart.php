
<?php include_once "components/header.php";?>

<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 ">
    <h1 class="text-center text-3xl font-bold  text-gray-900 "> Cart</h1>

    <form class="mt-12">
      <section aria-labelledby="cart-heading">
        <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

        <ul role="list" class="divide-y divide-gray-200 border-b border-t border-gray-200">
          <li class="flex py-6">
            <div class="flex-shrink-0">
              <img src="https://tailwindui.com/img/ecommerce-images/checkout-page-03-product-04.jpg" alt="Front side of mint cotton t-shirt with wavey lines pattern." class="h-24 w-24 rounded-md object-cover object-center sm:h-32 sm:w-32">
            </div>

            <div class="ml-4 flex flex-1 flex-col sm:ml-6">
              <div>
                <div class="flex justify-between">
                  <h4 class="text-sm">
                    <a href="#" class="font-medium text-gray-700 hover:text-gray-800">Artwork Tee</a>
                  </h4>
                  <p class="ml-4 text-sm font-medium text-gray-900">$32.00</p>
                </div>
                <p class="mt-1 text-sm text-gray-500">1 Update </p>
        
              </div>

              <div class="mt-4 flex flex-1 items-end justify-between">
                <p class="flex items-center space-x-2 text-sm text-gray-700">
                  <svg class="h-5 w-5 flex-shrink-0 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                  </svg>
                  <span>In stock</span>
                </p>
                <div class="ml-4">
                  <button type="button" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    <span>Remove</span>
                  </button>
                </div>
              </div>
            </div>
          </li>
       
          <!-- More products... -->
        </ul>
      </section>

      <!-- Order summary -->
      <section aria-labelledby="summary-heading" class="mt-10">
        <h2 id="summary-heading" class="sr-only">Order summary</h2>

        <div>
          <dl class="space-y-4">
            <div class="flex items-center justify-between">
              <dt class="text-base font-medium text-gray-900">Total</dt>
              <dd class="ml-4 text-base font-medium text-gray-900">$96.00</dd>
            </div>
          </dl>

        </div>

        <div class="mt-10">
          <button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Checkout</button>
        </div>

        <div class="mt-4">
          <button type="submit" class="w-full rounded-md border border-transparent bg-red-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Delete cart</button>
        </div>

        <div class="mt-6 text-center text-sm">
          <p>
            or
            <a href="/" class="font-medium text-indigo-600 hover:text-indigo-500">
              Continue Shopping
              <span aria-hidden="true"> &rarr;</span>
            </a>
          </p>
        </div>
      </section>
    </form>
  </div>
</div>


<?php include_once "components/footer.php"  ?>

<script>
    $(document).ready(function(){




    })
</script>
