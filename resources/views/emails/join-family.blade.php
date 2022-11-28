<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>You been invited to Join the {{ $familyName }} family</title>
  <style type="text/css">
      html,body {
        margin:0;
        padding:0;
      }

      @media screen and (max-width: 780px) {
        table[width="750"] {
          width:100%;
        }

        table[width="585"],table[width="625"] {
          width:0%;
        }

        table[width="625"] h2 {
          width:calc(100% - 192px) !important;
        }
      }

      @media screen and (max-width: 640px) {
        table[width="625"] h2,table[width="625"] .logo,table[width="625"] .social,p {
          display:block !important;
          width:100% !important;
          float:left !important;
          text-align:center !important;
        }

        table[width="625"] h2 {
          margin:10px 0 20px !important;
        }

        table[width="625"] .logo img {
          display:inline-block !important;
        }

        table[width="625"] .social a {
          display:inline-block !important;
          width:auto !important;
          float:none !important;
        }
      }

      @media screen and (max-width: 520px) {
        .heading {
          font-size:30px !important;
          line-height:34px !important;
        }

        .paragraph {
          font-size:20px !important;
          line-height:32px !important;
        }

        td[height="80"] {
          height:50px;
        }

        td[height="60"] {
          height:35px;
        }

        td[height="35"] {
          height:20px;
        }
      }
  </style>
</head>

<body style="background-color: rgb(189, 189, 189);">
    <!--Change background color here-->
    <table cellpadding="0" width="750" align="center" bgcolor="white" style="background:rgb(255, 242, 208);background-image: linear-gradient(#ffffff, #ffffff);margin:5% auto;" cellspacing="0" border="0">
      <!-- Header -->
      <tr>
        <td>
          <table cellpadding="0" cellspacing="0" width="625" align="center" style="margin:0 auto; ">
            <tr>
              <td height="35"></td>
            </tr>
            <tr>
              <!--Logo --->
              </tr>
              <tr>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td>
            <table cellpadding="0" cellspacing="0" width="100%" style="text-align:center;">
              <tr>
                <td height="80"></td>
              </tr>
              <tr>
                <td>
                  <table cellpadding="0" cellspacing="0" width="750" align="center" style="margin:0 auto;">
                    <tr>
                      <td><img style="width:100%;height:60%;" src="https://res.cloudinary.com/studio-mogwai/image/upload/v1575464117/ReadingDoodle.png" class="logo_img" alt="Hey there!">
                      </td>
                    </tr>
                    <tr>
                      <td height="60"></td>
                    </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" width="585" align="center" style="margin:0 auto;">
                    <tr>
                      <td class="paragraph" style="text-align:left;font-family:'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:300;font-size:30px;color:#000000;line-height:36px;">You been invited to join{{ $familyName }} family on meal planner<br><br>
                        <section style="font-size:17px">
                            To join {{ $familyName }} family click on the link below <br>
                            <a href="{{$link}}"></a>
                        <br>
                        <br>
                        If you're experiencing difficulties or you think this was a mistake, kindly send an email to <a href="mailto:planmymealapp@gmail.com">planmymealapp@gmail.com</a></a></section>
                    </td>
                    </tr>
                    <tr>
                      <td height="35"></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="60"></td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- Footer -->
        <tr>
        </tr>
      </table>
</html>
