# Imported Libraries
import bcrypt

# Input Variables
identifier = input("identifier >> ")  # $2a$, $2b$ or $2y$
rounder = input("rounder >> ")
texts = input(">> ").encode()

# Parameter-Based Conditioning

# Identifier Conditioning
if identifier == "":
    identifier = "$2b$"
elif identifier not in ["2a", "2b", "2y"]:
    print("\nInvalid identifier:", identifier, ". Using: $2b$ as identifier.")
    identifier = "2b"
    identifier = "$" + identifier + "$"
else:
    identifier = "$" + identifier + "$"

# Rounds Conditioning
if rounder == "":
    rounder = 12
else:
    rounder = int(rounder)
    if rounder < 4 or rounder > 31:
        print("Invalid rounder size:", rounder, ". Using: 12 as rounder.")
        rounder = 12

# Processing
salt = bcrypt.gensalt(rounder)
custom_salt = salt.decode().replace("$2b$", identifier).encode()

hashed = bcrypt.hashpw(texts, custom_salt)

print("\n<<", hashed.decode())
