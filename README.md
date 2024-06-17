# apkDownloader
This script acts as a middleware that fetches APK or XAPK files from a remote server (d.apkpure.net) and serves them to the client with modified filenames and necessary headers. 

This PHP script serves as a download proxy for APK and XAPK files from a specified URL, adding custom headers to modify the filename and allow cross-origin requests from a specific domain. Below is a detailed breakdown of its functionality:

### Script Breakdown

1. **Cross-Origin Resource Sharing (CORS) Header**:
   ```php
   header("Access-Control-Allow-Origin: https://www.game4free.tn");
   ```
   - This line allows cross-origin requests from the domain `https://www.game4free.tn`. It's a security feature to control who can access resources on your server.

2. **Parameter Validation**:
   ```php
   if (!isset($_GET['appName']) || !isset($_GET['extension'])) {
       http_response_code(400);
       die("Missing parameter");
   }
   ```
   - The script checks if both `appName` and `extension` parameters are provided in the URL query string.
   - If either is missing, it returns a 400 HTTP status code and terminates with the message "Missing parameter".

3. **Parameter Assignment**:
   ```php
   $appName = $_GET['appName'];
   $appExtension = $_GET['extension'];
   ```
   - The script retrieves the `appName` and `extension` values from the query string and assigns them to variables.

4. **File Download Logic**:
   - The script determines the download URL and sets the appropriate headers based on the file extension.

   **For XAPK files**:
   ```php
   if ($appExtension == 'XAPK'){
       $downloadLink = "https://d.apkpure.net/b/XAPK/" . urlencode($appName) . "?version=latest";
       
       $modifiedFilename = $appName . "_Game4Free.xapk";
       header("Content-Disposition: attachment; filename=\"$modifiedFilename\"");
       header("Content-Type: application/octet-stream");
   }
   ```
   - Constructs the download link for the XAPK file.
   - Sets the `Content-Disposition` header to suggest a filename for the download.
   - Sets the `Content-Type` header to indicate the file type as a binary stream.

   **For APK files**:
   ```php
   else{
       $downloadLink = "https://d.apkpure.net/b/APK/" . urlencode($appName) . "?version=latest";
       
       $modifiedFilename = $appName . "_Game4Free.apk";
       
       header("Content-Disposition: attachment; filename=\"$modifiedFilename\"");
       header("Content-Type: application/octet-stream");
   }
   ```
   - Constructs the download link for the APK file.
   - Sets the `Content-Disposition` and `Content-Type` headers similarly to the XAPK case, but with the `.apk` extension.

5. **File Delivery**:
   ```php
   readfile($downloadLink);
   ```
   - Reads the file from the specified URL and sends it to the client.

### Summary
This script acts as a middleware that fetches APK or XAPK files from a remote server (`d.apkpure.net`) and serves them to the client with modified filenames and necessary headers. This ensures that the downloads are properly labeled and allows cross-origin requests from a specific domain. The script includes error handling to ensure required parameters are present and uses PHP's `readfile` function to transfer the file to the client.
