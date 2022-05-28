import boto3
from botocore.exceptions import ClientError


SENDER = "Kenshiro Ata <nuuuukemw@gmail.com>"

RECIPIENT = "bugattiveyroooone@icloud.com"

# CONFIGURATION_SET = "ConfigSet"

AWS_REGION = "us-east-1"

# The subject line for the email.
SUBJECT = "Amazon SES Test (SDK for Python)"

# The email body for recipients with non-HTML email clients.
BODY_TEXT = ("Amazon SES Test (Python)\r\n"
             "This email was sent with Amazon SES using the "
             "AWS SDK for Python (Boto)."
            )

# The HTML body of the email.
BODY_HTML = """<html>
<head></head>
<body>
  <h1>Amazon SES Test (SDK for Python)</h1>
  <p>This email was sent with
    <a href='https://aws.amazon.com/ses/'>Amazon SES</a> using the
    <a href='https://aws.amazon.com/sdk-for-python/'>
      AWS SDK for Python (Boto)</a>.</p>
</body>
</html>
            """

CHARSET = "UTF-8"

client = boto3.client("ses", region_name=AWS_REGION)

# try to send the email.
try:
    response = client.send_email(
        Destination={
            "ToAddresses": [
                RECIPIENT,
            ],
        },
        Message={
            "Body": {
                "Html": {
                    "Charset": CHARSET,
                    "Data": BODY_HTML,
                },
            },
            "Subject": {
                "Charset": CHARSET,
                "Data": SUBJECT,
            },
        },
        Source=SENDER,
        # ConfigurationSetName=CONFIGURATION_SET,
    )
except ClientError as e:
    print(e.response["Error"]["Message"])
else:
    print("Email sent! Message ID: ")
    print(response["MessageId"])
