<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Your Event Ticket</title>

<style type="text/css">
	
  /* reset */
  #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */ 
  .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */  
  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */ 
  p {margin: 0; padding: 0; font-size: 0px; line-height: 0px;} /* squash Exact Target injected paragraphs */
  table td {border-collapse: collapse;} /* Outlook 07, 10 padding issue fix */
  table {border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; } /* remove spacing around Outlook 07, 10 tables */
  
  /* bring inline */
  img {display: block; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
  a img {border: none;} 
  a {text-decoration: none; color: #000001;} /* text link */
  a.phone {text-decoration: none; color: #000001 !important; pointer-events: auto; cursor: default;} /* phone link, use as wrapper on phone numbers */
  span {font-size: 13px; line-height: 17px; font-family: monospace; color: #000001;}
</style>
<!--[if gte mso 9]>
  <style>
  /* Target Outlook 2007 and 2010 */
  </style>
<![endif]-->
</head>
<body style="width:100%; margin:0; padding:0; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;font-family: arial;">

<!-- body wrapper -->
<table cellpadding="0" cellspacing="0" border="0" style="margin:0; padding:0; width:100%; line-height: 100% !important;">
  <tr>
    <td valign="top">
      <!-- edge wrapper -->
      <table cellpadding="0" cellspacing="0" border="0" width="600" style="background: #fff;">
        <tr>
          <td valign="top">
            <!-- content wrapper -->
            <!-- <table cellpadding="0" cellspacing="0" border="0" align="center" width="560" style="background: #cfcfcf;">
              <tr>
                <td valign="top" style="vertical-align: top;"> -->
                  <!-- ///////////////////////////////////////////////////// -->

                  <table cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                      <td valign="top" style="vertical-align: top;">
                        <div style="padding:10px 0;">
                        <img src="{{ url() }}/img/logo.png" alt="OGP Logo" title="OGP Logo" width="30" />
                        </div>
                      </td>
                    </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr height="30">
                      <td valign="top" style="vertical-align: top;" width="600" >
                        <h2 style="margin: 0 0 40px 0; line-height:1.4">{{ $eventtitle }}</h2>
                        <h2 style=" margin: 0 0 10px 0;">
                            {{ gmdate('D, M j',$fromtime) }} @ {{ gmdate('g : i a',$fromtime) }} - {{ gmdate('g : i a' ,$totime) }}
        
                        </h2>
                        <div style="margin: 0 0 10px 0;"> {{ $location }}</div>
                        <div style="margin: 0 0 20px 0;">
                            <span style="text-align: right; width: 50px;">Price:</span> C${{ $eventfee }}<br>
                            <span style="text-align: right; width: 50px;">HST/GST:</span> C${{ $eventfee*0.13 }}<br>
                            <span style="text-align: right; width: 50px;">Ticket Total:</span> C${{ $eventfee + $eventfee*0.13 }}
                        </div>
                        <div style=" margin-bottom:30px;">
                          {{ $ticketnumber }}
                        </div>
                      </td>
                    </tr>
                  </table>

                  <!-- //////////// -->
                <!-- </td>
              </tr>
            </table> -->
            <!-- / content wrapper -->
          </td>
        </tr>
      </table>
      <!-- / edge wrapper -->
    </td>
  </tr>
</table>  
<!-- / page wrapper -->
</body>
</html>