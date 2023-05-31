$(function () {
  let $win = $(window);
  let $doc = $(document);

  $doc.on("click", ".js-checkout-cart", function () {
    $.ajax({
      type: "POST",
      url: "assets/php/ajax/handleCheckoutCart.php",
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (data.status === 1) {
          window.location.href = "/confirmation?orderId=" + data.orderId;
        } else {
          alert(data.message);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      },
    });
  });

  $doc.on("click", ".js-add-item-cart", function () {
    if ($(this).hasClass("logged-in")) {
      // Get the parent container
      var $productInputs = $(this).closest(".product-inputs");

      // Extract the product id from the data attribute
      var itemId = $productInputs.data("product-id");

      // Extract the quantity from the appropriate input field
      var qty = $productInputs.find('input[type="number"]').val();

      $.ajax({
        type: "POST",
        url: "assets/php/ajax/handleAddCartItem.php",
        data: {
          itemId: itemId,
          qty: qty,
        },
        dataType: "json",
        success: function (data) {
          console.log(data);
          if (data.status == 1) {
            if (data.cart.length > 0) {
              $(".js-cart-item-count")
                .addClass("has-items")
                .attr("data-item-count", data.cart.length);
              alert("Added item to cart!");
            } else {
              $(".js-cart-item-count").removeClass("has-items");
            }
          } else {
            alert(data.message);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus, errorThrown);
        },
      });
    } else {
      openPopup("popup-login");
    }
  });

  $doc.on("click", ".js-remove-cart-item", function (e) {
    e.preventDefault();
    // Extract the product id from the data attribute
    var itemId = $(this).data("item-id");
    var qty = $(this).data("item-qty");

    $.ajax({
      type: "POST",
      url: "assets/php/ajax/handleRemoveCartItem.php",
      data: {
        itemId: itemId,
        qty: qty,
      },
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (data.status == 1) {
          window.location.reload();
        } else {
          alert(data.message);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      },
    });
  });

  function fetchCartItems() {
    $.ajax({
      type: "GET",
      url: "assets/php/ajax/handleGetCartItems.php",
      dataType: "json",
      success: function (data) {
        if (data.status == 1) {
          if (data.cart.length > 0) {
            $(".js-cart-item-count")
              .addClass("has-items")
              .attr("data-item-count", data.cart.length);
          } else {
            $(".js-cart-item-count").removeClass("has-items");
          }
        } else {
          alert(data.message);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      },
    });
  }

  $("#login-form").validate({
    rules: {
      username: {
        required: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
      username: {
        required: "Please provide a username",
      },
      password: {
        required: "Please provide a password",
      },
    },
    submitHandler: function (form) {
      console.log("Form Submitted");

      $.ajax({
        type: "POST",
        url: "assets/php/ajax/handleLogin.php",
        data: $(form).serialize(),
        dataType: "json",
        success: function (data) {
          console.log("Success: ", data);
          if (data.status == 1) {
            window.location.reload();
          } else {
            $(form)
              .find(".validation-error")
              .html(data.message)
              .addClass("active");
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("Error: ", textStatus, errorThrown);
        },
      });

      return false;
    },
  });

  $("#register-form").validate({
    rules: {
      firstname: {
        required: true,
        minlength: 2,
      },
      lastname: {
        required: true,
        minlength: 2,
      },
      username: {
        required: true,
        minlength: 5,
      },
      email: {
        required: true,
      },
      address: {
        required: true,
      },
      password: {
        required: true,
        minlength: 6,
      },
    },
    messages: {
      firstname: {
        required: "Please provide your first name",
        minlength: "Your first name must be at least 2 characters long",
      },
      lastname: {
        required: "Please provide your last name",
        minlength: "Your last name must be at least 2 characters long",
      },
      username: {
        required: "Please provide a username",
        minlength: "Your username must be at least 5 characters long",
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long",
      },
    },
    submitHandler: function (form) {
      console.log("Form Submitted");

      $.ajax({
        type: "POST",
        url: "assets/php/ajax/handleRegister.php",
        data: $(form).serialize(),
        dataType: "json",
        success: function (data) {
          console.log("Success: ", data);
          if (data.status == 1) {
            window.location.reload();
          } else {
            $(form)
              .find(".validation-error")
              .html(data.message)
              .addClass("active");
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("Error: ", textStatus, errorThrown);
        },
      });

      return false;
    },
  });

  function openPopup(popupId) {
    console.log("Opening " + popupId + " Popup...");
    $doc.find(".active").removeClass("active");
    $doc.find("#" + popupId).addClass("active");
  }

  $doc.on("click", ".js-login-popup", function () {
    openPopup("popup-login");
  });

  $doc.on("click", ".js-register-popup", function () {
    openPopup("popup-register");
  });

  $doc.on("click", ".close-button", function () {
    $doc.find(".active").removeClass("active");
  });

  $doc.on("click", ".logout", function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "assets/php/ajax/handleLogout.php",
      success: function (data) {
        console.log("Success: ", data);
        if (data.status == 1) {
          window.location.reload();
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error: ", textStatus, errorThrown);
      },
    });
  });

  fetchCartItems();

  AOS.init();
});
