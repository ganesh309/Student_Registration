











































// function printStudentDetails(studentId) {
//     const studentRow = document.querySelector(`#student-row-${studentId}`);
//     if (!studentRow) return;

//     const iframe = document.createElement('iframe');
//     iframe.style.cssText = 'position:fixed;right:0;bottom:0;width:0;height:0;border:0;';
//     document.body.appendChild(iframe);

//     const printDocument = iframe.contentWindow.document;

//     printDocument.open();
//     printDocument.write(`
//         <html>
//             <head>
//                 <title>Student Details - ${studentRow.querySelector('td:nth-child(2)').textContent}</title>
//                 <style>
//                     @media print {
//                         * {
//                             font-family: 'Arial', sans-serif;
//                             line-height: 1.4;
//                             color: #333;
//                         }

//                         body {
//                             margin: 1cm;
//                         }

//                         .header {
//                             display: flex;
//                             justify-content: space-between;
//                             align-items: center;
//                             margin-bottom: 20px;
//                             border-bottom: 2px solid #ccc;
//                             padding-bottom: 15px;
//                         }

//                         .student-photo {
//                             width: 150px;
//                             height: 150px;
//                             border: 1px solid #ddd;
//                             padding: 3px;
//                         }

//                         .details-table {
//                             width: 100%;
//                             border-collapse: collapse;
//                             margin: 10px 0;
//                         }

//                         .details-table th {
//                             background: #f5f5f5;
//                             text-align: left;
//                             padding: 8px;
//                             border: 1px solid #ddd;
//                             width: 30%;
//                         }

//                         .details-table td {
//                             padding: 8px;
//                             border: 1px solid #ddd;
//                             width: 70%;
//                         }

//                         .section-title {
//                             background: #e9ecef;
//                             font-weight: bold;
//                             padding: 6px;
//                             margin-top: 15px;
//                             border-left: 4px solid #2c3e50;
//                         }
//                         .signature-box {
//                             margin-top: 15px;
//                             float: right;
//                             text-align: center;
//                         }

//                         .signature-img {
//                             width: 200px;
//                             height: 60px;
//                             margin-top: 20px;
//                             padding-top: 5px;
//                         }

//                         .footer {
//                             position: fixed;
//                             bottom: 0;
//                             right: 0;
//                             font-size: 0.8em;
//                             color: #666;
//                         }
//                     }
//                 </style>
//             </head>
//             <body>
//                 <div class="header">
//                     <div>
//                         <h2>${studentRow.querySelector('td:nth-child(2)').textContent}</h2>
//                         <p>Student ID: ${studentRow.querySelector('td:nth-child(1)').textContent}</p>
//                         <p>Course: ${studentRow.querySelector('td:nth-child(9)').textContent}</p>
//                     </div>
//                     ${studentRow.querySelector('td img') ? 
//                     `<img src="${studentRow.querySelector('td img').src}" class="student-photo" alt="Student Image">` : ''}
//                 </div>

//                 <div class="section-title">Personal Information</div>
//                 <table class="details-table">
//                     <tr>
//                         <th>Date of Birth</th>
//                         <td>${studentRow.querySelector('td:nth-child(5)').textContent}</td>
//                     </tr>
//                     <tr>
//                         <th>Gender</th>
//                         <td>${studentRow.querySelector('td:nth-child(6)').textContent}</td>
//                     </tr>
//                     <tr>
//                         <th>Father's Name</th>
//                         <td>${studentRow.querySelector('td:nth-child(3)').textContent}</td>
//                     </tr>
//                     <tr>
//                         <th>Mother's Name</th>
//                         <td>${studentRow.querySelector('td:nth-child(4)').textContent}</td>
//                     </tr>
//                 </table>

//                 <div class="section-title">Contact Information</div>
//                 <table class="details-table">
//                     <tr>
//                         <th>Email Address</th>
//                         <td>${studentRow.querySelector('td:nth-child(7)').textContent}</td>
//                     </tr>
//                     <tr>
//                         <th>Phone Number</th>
//                         <td>${studentRow.querySelector('td:nth-child(8)').textContent}</td>
//                     </tr>
//                     <tr>
//                         <th>Address</th>
//                         <td>
//                             ${studentRow.querySelector('td:nth-child(16)').textContent},<br>
//                             ${studentRow.querySelector('td:nth-child(15)').textContent},<br>
//                             ${studentRow.querySelector('td:nth-child(14)').textContent} - 
//                             ${studentRow.querySelector('td:nth-child(17)').textContent}
//                         </td>
//                     </tr>
//                 </table>

//                 <div class="section-title">Academic Information</div>
//                 <table class="details-table">
//                     <tr>
//                         <th>Institution</th>
//                         <td>${studentRow.querySelector('td:nth-child(13)').textContent}</td>
//                     </tr>
//                     <tr>
//                         <th>Class</th>
//                         <td>${studentRow.querySelector('td:nth-child(11)').textContent}</td>
//                     </tr>
//                     <tr>
//                         <th>Roll Number</th>
//                         <td>${studentRow.querySelector('td:nth-child(12)').textContent}</td>
//                     </tr>
//                     <tr>
//                         <th>Specialization</th>
//                         <td>${studentRow.querySelector('td:nth-child(10)').textContent}</td>
//                     </tr>
//                 </table>

//                 <div class="signature-box">
//                     ${studentRow.querySelector('td img[alt="Signature"]') ? 
//                     `<img src="${studentRow.querySelector('td img[alt="Signature"]').dataset.bsSignature}" 
//                         class="signature-img" alt="Signature">` : 
//                     '<div class="signature-img">[Signature]</div>'}
//                     <div style="margin-top:5px;">Student Signature</div>
//                 </div>

//                 <div class="footer">
//                     Printed on: ${new Date().toLocaleDateString()}
//                 </div>
//             </body>
//         </html>
//     `);

//     printDocument.close();
//     iframe.onload = function() {
//         setTimeout(() => {
//             iframe.contentWindow.focus();
//             iframe.contentWindow.print();
//             setTimeout(() => document.body.removeChild(iframe), 1000);
//         }, 500);
//     };
// }
