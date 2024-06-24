// this moves the page down to the bottom //////////////////////////////////////////////////////
function movePage()
{
  $('html, body').animate({ scrollTop: $(document).height() }, 1);
}

// 
function chevronDirection()
{
  //$('#sortChev').attr('src', '/assets/downChevronScaledDown.png');
  // check if the value is true or false changing the image source accordingly
  if($('#aSortIn').val() == 'false')
  {
    // upward chevron
    $('#sortChev').attr('d', 'M 567.35,52.36 C 567.35,52.36 51.86,567.85 51.86,567.85 51.86,567.85 148.04,664.03 148.04,664.03 148.04,664.03 568.06,244.00 568.06,244.00 568.06,244.00 986.67,662.61 986.67,662.61 986.67,662.61 1082.14,567.14 1082.14,567.14 1082.14,567.14 567.35,52.36 567.35,52.36 Z');
  }
  else
  {
    // downward chevron
    $('#sortChev').attr('d', 'M 566.65,664.64 C 566.65,664.64 1082.14,149.15 1082.14,149.15 1082.14,149.15 985.96,52.97 985.96,52.97 985.96,52.97 565.94,473.00 565.94,473.00 565.94,473.00 147.33,54.39 147.33,54.39 147.33,54.39 51.86,149.86 51.86,149.86 51.86,149.86 566.65,664.64 566.65,664.64 Z');
  }
}