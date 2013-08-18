Isotope Payment Skeleton
========================

Skeleton of payment implementation for Isotope webshop for Contao.


Skeleton without hidden trigger
-------------------------------

After order checkout the client is redirected to a payment service URL. This URL
contains form to input payment data like credit card number. After submit this
form the client is redirected back to shop. This redirect contains information
about payment state.

Because the client trigger the order state, only if the client return to shop,
the shop obtains payment state.  


Skeleton with hidden trigger
----------------------------

After order checkout the client is redirected to a payment service URL. This URL
contains form to input payment data like credit card number. While submit this
form the payment service call a script from shop to. This call contains
information about payment state. After this call the client is redirect back
to shop.

Because the script call hidden from client, the shop obtains payment state even
the client do not return to shop. The client do not trigger the order state,
the payment service trigger it.
