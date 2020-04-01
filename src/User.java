public class User
{
    private String username;
    private String password;
    private int type;
    public User(final String username, final String password, int type)
    {
        this.username = username;
        this.password = password;
        this.type = type;

    }

    public final String getUsername()
    {
        return username;
    }

    public final String getPassword()
    {
        return password;
    }

    public final int getType()
    {
        return type;
    }
}
