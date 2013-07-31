Isotope Payment Skeleton
========================

Skeleton of payment implementation for Isotope webshop for Contao.


Skeleton without hidden trigger
-------------------------------

After order checkout the client is redirected to a payment service URL. This URL
contains form to input payment data like credit card number. After submit this
form the client is redirected back to shop. This redirect contains information
about payment status.

Only if the client return to shop, the shop obtain payment status. 
